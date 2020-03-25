<?php
    require "header.php";
    $profileId = $_GET['profileId'];
    $id;
    if(empty($profileId)){
        if (session_status() == PHP_SESSION_ACTIVE) {
            require "../Includes/Dbh.inc.php";
            $id = $_SESSION['userId'];
            header("Location: selectProfile.php");
            exit();

            //  Build the statement.
            //  Find the defaultprofileUsers of a user whos uid matches ?
            $sql = "SELECT defaultprofileUsers FROM users WHERE idUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo(mysqli_info($stmt));
                //header("Location: ../php/home.php?error=fetchprofilesqlerror");
                exit();
            }
            else{
                //  Run the statement
                //  Get the defaultprofileUsers of the currently logged in user
                mysqli_stmt_bind_param($stmt, "s", $id);
                mysqli_stmt_execute($stmt);
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $profileId = $user['defaultprofileUsers'];
                echo $profileId;
            }
        }else{
            header("Location= Home.php?error=nosessionprofile");
        }
    }
    // Fetch data for profile
    require "../Includes/GetProfile.inc.php";
    $profile = getProfileById($profileId);
    $profileDir = "../".$profilesDir.$profileId."/";
    $profilePfpSrc = $profileDir."pfp/pfp.png";
    $profileName = $profile['nameProfiles'];
    $profileTagline = $profile['taglineProfiles'];

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo("VC - ".$profileName."'s profile") ?></title>
        <link rel="stylesheet" type="text/css" href="../Css/Profile.css">
    </head>
    <body>
        <div id="body_div">
            <div id="body_profile_div">
                <div id="body_profilecover_div">
                    <img id="body_profilecover_pfp_img" class="imgs" src=<?php echo'"'.$profilePfpSrc.'"'; ?>>
                    <div id="body_profilecover_txt_div">
                        <h1 id="body_profilecover_name_txt" class="txt"><?php echo($profileName);?></h1>
                        <h2 id="body_profilecover_tagline_txt" class="txt"><?php echo($profileTagline)?></h2>
                    </div>
                <div>

                <div id="body_profilecontent_div">

                </div>
            </div>
        </div> 
    </body>
</html>