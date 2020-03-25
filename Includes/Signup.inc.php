<?php
require "basic.inc.php";
if(isset($_POST['signup'])){
    echo($_POST['signup']);

    require "dbh.inc.php";

    $username = $_POST['uid'];
    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd-repeat'];

    // Basic user entry tests
    if (empty($username) || empty($password) || empty($password_repeat)){
        header("Location: ../php/signup.php?error=emptyfields&uid=".$username);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../php/signup.php?error=baduid");
        exit();
    }
    else if ($password !== $password_repeat){
        header("Location: ../php/signup.php?error=passwordmismatch&uid=".$username);
        exit();
    }
    else {
        // Build the statement.
        // Find users with a uid that matches ?
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../php/signup.php?error=sqlerror&uid=".$username);
            exit();
        }
        else{
            // Run the statement.
            // Test the user supplied uid against the DB, send user back if uid already exists.
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);
            if($result > 0){
                header("Location: ../php/signup.php?error=uidtaken");
                exit();
            }
            else{
                // Build the statement.
                // Insert a user with values ? and ?
                $sql = "INSERT INTO users (uidUsers, pwdUsers) VALUES (?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../php/signup.php?error=sqlerror&uid=".$username);
                    exit();
                }
                else{
                    // Run the statement.
                    // Actually commit the user to the DB.
                    $hashpwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $username, $hashpwd);
                    mysqli_stmt_execute($stmt);

                    //  Build the statement.
                    //  Find the id of a user whos uid matches ?
                    $sql = "SELECT idUsers FROM users WHERE uidUsers=?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../php/signup.php?error=dircreationfailsql");
                        exit();
                    }
                    else{
                        //  Run the statement
                        //  Get the id of the user that was just created
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        $user = $result->fetch_assoc();
                        $id = $user['idUsers'];
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        echo $id;

                        

                        //  After user is created in DB, crate Rec/Users/Users/{idUsers} folder from a template
                        //      (Templates located in Rec/Users/Template Users/idUsers)
                        dirCopy("/web3final/rec/users/template users/idusers", "/web3final/rec/users/users/".$id, false); // <=== the directories do not need "../" here because the Basic => dirCopy appends "C:/xampp/htdocs/web3final". This is a temp fix and should be fixed at a later point
                        
                        
                        header("Location: ../php/login.php");
                        exit();
                    }

                    
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

else{
    header("Location: ../php/signup.php");
    exit();
}