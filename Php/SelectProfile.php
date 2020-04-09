<?php
    require "header.php";
    if(!isset($_SESSION['login']) || $_SESSION['login'] == ""){
        header("Location: ../php/home.php");
        exit;
    }else{
        require "../Includes/GetProfile.inc.php";
        $userId = $_SESSION['userId'];
        if(!$userId==""){
        $profiles = qryyProfilesByUserId($userId);
        }
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>VC - Select Profile</title>
        <link rel="stylesheet" type="text/css" href="../css/Forms.css">
        <link rel="stylesheet" type="text/css" href="../css/SelectProfile.css">
        <?php
            //require "header.php";
        ?>
    </head>
    <body>
        <div id="body_page_div">
            <div id="body_profilelist_div">
                <?php
                if(!$profiles==null){
                    foreach($profiles as &$profile){
                        if($profile[1]==$userId){
                            echo('<a href="profile.php?profileId='.$profile[0].'" class="body_profilelist_profiles_as""><div class="body_profilelist_profiles_divs"><div class="body_profilelist_profiles_img_divs"><img src="../rec/profiles/profiles/'.$profile[0].'/pfp/pfp.png" class="body_profilelist_profiles_imgs"></div><h1>'.$profile[2].'</h1></div></a>');
                        }
                    }
                }
                ?>
                <a href="createprofile.php">
                    <div id="body_profilelist_addnew_div">
                        <div id="body_profilelist_addnew_img_div">
                            <img src="../rec/img/addprofile/addprofile.png" id="body_profilelist_addnew_img" class="body_profilelist_profiles_imgs">
                        </div>
                        <h1>Add new profile</h1>
                    </div>
                </a>
            </div>
            <?php
            echo('<a href="../php/User.php?userId='.$userId.'"><div class="form_divs"><button>View user page</button></div></a>');
            ?>
        </div>
    </body>
</html>