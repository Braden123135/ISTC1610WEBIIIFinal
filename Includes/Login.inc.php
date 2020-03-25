<?php
if(isset($_POST['login'])){

    require "dbh.inc.php";

    $username = $_POST['uid'];
    $password = $_POST['pwd'];

    // Basic user entry tests.
    if(empty($username) || empty($password)){
        header("Location: ../php/login.php?error=emptyfields&uid=".$username);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../php/login.php?error=baduid");
        exit();
    }
    else{
        // Prepare the statement.
        // Find a user whos uid matches ?
        $sql = "SELECT * FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../php/login.php?error=sqlerror&uid=".$username);
            exit();
        }
        else{
            // Run the statement.
            // Find a user with the same uid as the user provided uid, and the same password as the user provided password.
            
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if(!$pwdCheck){
                    header("Location: ../php/login.php?error=invalidcredentials&uid=".$username);
                    exit();
                }
                else if($pwdCheck){
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    $_SESSION['login'] = 1;
                    
                    header("Location: ../php/home.php?login=success");
                    exit();
                }
                else{
                    header("Location: ../php/login.php?error=invalidcredentials&uid=".$username);
                    exit();
                }
            }
            else{
                header("Location: ../php/login.php?error=invalidcredentials&uid=".$username);
                exit();
            }
        }
    }

}
else{
    header("Location: ../php/login.php");
    exit();
}