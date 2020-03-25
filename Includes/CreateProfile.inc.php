<?php
session_start();
require "Basic.inc.php";
if(!isset($_POST['createprofile'])){
    header("Location: ../php/login.php");
}else{
    require "dbh.inc.php";

    if (!isset($_SESSION['login']) || $_SESSION['login']==""){
        header('Location: ../php/home.php');
    }else{
        echo($_SESSION['userId']);
        $profileName = $_POST['profileName'];
        $profileTagline = $_POST['profileTagline'];
        $id = $_SESSION['userId'];
        echo($_POST['profileTagline']);

        if(empty($profileName)){
            header("Location: ../php/Home.php?error=emptyfields&profileTagline=".$profileTagline);
            exit();
        }else{
            if((!preg_match("/^[a-zA-Z0-9 ]*$/", $profileTagline) && (!!preg_match("/^[a-zA-Z0-9 ]*$/", $profileName)))){
                header("Location: ../php/Home.php?error=badfields");
                exit();
            }else{
                // Create the profile

                // Build the statement
                $sql;
                if(!empty($profileTagline)){
                    $sql = "INSERT INTO profiles (iduserprofilesProfiles, nameProfiles, taglineProfiles) VALUES (?, ?, ?)";
                }else{
                    $sql = "INSERT INTO profiles (iduserprofilesProfiles, nameProfiles) VALUES (?, ?)";
                }
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../php/home.php?error=sqlerror&profileName=".$profileName);
                    exit();
                }else{
                    // Run the statement
                    if(!empty($profileTagline)){
                        mysqli_stmt_bind_param($stmt, "sss", $id, $profileName, $profileTagline);
                    }else{
                        mysqli_stmt_bind_param($stmt, "ss", $id, $profileName);
                    }
                    mysqli_stmt_execute($stmt);

                    //  Build the statement.
                    //  Find the id of a profile whos iduserprofilesProfile matches ?
                    $sql = "SELECT idProfiles FROM profiles WHERE iduserprofilesProfiles=? ORDER BY 'creationdateProfiles'";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        //header("Location: ../php/createprofile.php?error=dircreationfailsql");
                        exit();
                    }
                    else{
                        //  Run the statement
                        //  Get the id of the profile that was just created
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']); // <=== this doesnt work because a user can have multiple profiles
                        mysqli_stmt_execute($stmt);
                        //mysqli_stmt_store_result($stmt);
                        $result = $stmt->get_result();
                        $profiles = $result->fetch_all(MYSQLI_ASSOC);
                        var_dump($profiles);
                        $profile = end($profiles);
                        $id = $profile['idProfiles'];
                        echo($id);

                        dirCopy("/web3final/rec/profiles/template profiles/idprofiles", "/web3final/rec/profiles/profiles/".$id, false);
                        header("Location: ../php/profile.php?profileId=".$id);
                        exit();
                    }
                }
            }
        }
    }
}