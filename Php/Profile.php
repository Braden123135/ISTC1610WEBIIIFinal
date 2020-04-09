<?php
    require "header.php";
    $profileId = $_GET['profileId'];
    $id;
    if(empty($profileId)){
        if(!isset($_SESSION['login']) || $_SESSION['login'] == ""){
            header("Location: ../php/Home.php");
            exit();
        } else {
            header("Location: ../php/SelectProfile.php");
            exit();
        }
    }
    // Fetch data for profile
    require "../Includes/GetProfile.inc.php";
    $profile = getProfileById($profileId);
    $profileDir = "../".$profilesDir.$profileId."/";
    $profilePfpSrc = $profileDir."pfp/pfp.png";
    $profileName = $profile['nameProfiles'];
    $profileTagline = $profile['taglineProfiles'];
    $profileOwner = $profile['iduserprofilesProfiles'];
    $loggedIn = null;
    if(!isset($_SESSION['login']) || $_SESSION['login'] == ""){
        $loggedIn = false;
    } else {
        $loggedIn = $_SESSION['userId'];
    }

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
                    <img id="body_profilecover_profilePfp_img" class="imgs" src=<?php echo'"'.$profilePfpSrc.'"'; ?>>
                    <div id="body_profilecover_txt_div">
                        <?php if($loggedIn == $profileOwner){echo('<a href="../php/editProfile.php?profileId='.$profileId.'"> <button>Edit Profile</button></a>');} ?>
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