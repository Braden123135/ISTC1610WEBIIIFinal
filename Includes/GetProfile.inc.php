<?php
require "dbh.inc.php";

$profilesDir = "rec/profiles/profiles/";

function qryyProfilesByUserId($userId){
    global $conn;
    // Array: Array of profiles, each profile has the data found in database for that profile
    // 0: no profiles were found
    // -1: error

    //build the statement
    if(!preg_match("/^[0-9]+$/", $userId)){
        return -1;
    }else{
        $sql = "SELECT * FROM profiles WHERE iduserprofilesProfiles=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../php/home.php?error=getprofilesqlerror");
        }else{
            //Run the statement
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            $profiles = $result->fetch_all();
            return $profiles;
        }
    }
}

function qrryProfilesByName($profileName){

}

function getProfileById($profileId){
    global $conn;
    if(!preg_match("/^[0-9]+$/", $profileId)){
        return -1;
    } else {
        // Build the statement
        // Find a profile whos id = ?
        $sql = "SELECT * FROM profiles WHERE idProfiles=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //header("Location: ../php/home.php?error=sqlerror");
        } else {
            // Run the statement
            // Find the profile with the id specified
            mysqli_stmt_bind_param($stmt, "i", $profileId);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            $profile = $result->fetch_assoc();
            return $profile;
        }
    }
}