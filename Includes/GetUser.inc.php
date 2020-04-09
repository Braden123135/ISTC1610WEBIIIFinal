<?php
require "dbh.inc.php";

$usersDir = "rec/users/users/";

function qryyUsersByUserId($userId){
    global $conn;
    // Array: Array of users, each user has the data found in database for that user
    // 0: no users were found
    // -1: error

    //build the statement
    if(!preg_match("/^[0-9]+$/", $userId)){
        return -1;
    }else{
        $sql = "SELECT * FROM users WHERE idUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../php/home.php?error=getusesrsqlerror");
        }else{
            //Run the statement
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            $users = $result->fetch_all();
            return $users;
        }
    }
}

function qrryUsersByName($userName){

}

function getUserById($userId){
    global $conn;
    if(!preg_match("/^[0-9]+$/", $userId)){
        return -1;
    } else {
        // Build the statement
        // Find a user whos id = ?
        $sql = "SELECT * FROM users WHERE idUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //header("Location: ../php/home.php?error=sqlerror");
        } else {
            // Run the statement
            // Find the user with the id specified
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($user['idUsers'] != $userId){
                header("Location: ../php/home.php");
                exit();
            }else{
                return $user;
            }
        }
    }
}