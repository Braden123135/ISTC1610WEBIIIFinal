<?php
if(isset($_POST['signup'])){

    require "dbh.inc.php";

    $useranme = $_POST['uid'];
    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd-repeat'];

    // Basic user entry tests
    if (empty($useranme) || empty($password) || empty($password_repeat)){
        header("Location: ../signup.php?error=emptyfields&uid=".$useranme);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=baduid");
        exit();
    }
    else if ($password !== $password_repeat){
        header("Location: ../signup.php?error=passwordmismatch&uid=".$useranme);
        exit();
    }
    else {
        // Build the statement.
        // Find users with a uid that matches ?
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror&uid=".$useranme);
            exit();
        }
        else{
            // Run the statement.
            // Test the user supplied uid against the DB, send user back if uid already exists.
            mysqli_stmt_bind_param($stmt, "s", $useranme);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../signup.php?error=uidtaken");
                exit();
            }
            else{
                // Build the statement.
                // Add a user that matches ? and ?
                $sql = "INSERT INTO users (uidUsers, pwdUsers) VALUES (?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlerror&uid=".$useranme);
                    exit();
                }
                else{
                    // Run the statement.
                    // Actually commit the user to the DB.
                    $hashpwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $useranme, $hashpwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../home.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

else{
    header("Location: ../signup.php");
    exit();
}