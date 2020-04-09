<?php
    require "../php/header.php";
    require "../includes/GetUser.inc.php";
    require "../Includes/GetProfile.inc.php";
    $profiles = null;
    $userId = $_GET['userId'];
    $id;
    if(empty($userId)){
        if(!isset($_SESSION['login']) || $_SESSION['login'] == ""){
            header("Location: ../php/Login.php?");
            exit();
        }else{
            $userId = $_SESSION['userId'];
            header("Location: ../php/User.php?userId=".$userId);
            exit();
        }
    }else{
        // Regex check the user ID
        if(!preg_match("/^[0-9]+$/", $userId)){
            header("Location: ../php/home.php");
        }else{
            // Set the things that need to be set so the website go
            $user = getUserById($userId);
            $usersDir = "../".$usersDir.$userId."/";
            $userPfpSrc = $usersDir."pfp/pfp.png";
            $userName = $user['uidUsers'];
            $profiles = qryyProfilesByUserId($user['idUsers']);
            $loggedIn = null;
            if(!isset($_SESSION['login']) || $_SESSION['login'] == ""){
                $loggedIn = false;
            } else {
                $loggedIn = $_SESSION['userId'];
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>VC - <?php echo($userName);?>'s userpage</title>
    <link rel="stylesheet" type="text/css" href="../css/User.css">
</head>
<body>
    <div id="body_page_div">
        <div id="body_page_top_div"></div>
        <div id="body_page_bottom_div">
            <img id="body_page_bottom_userPfp_img" src=<?php echo($userPfpSrc);?>>
            <?php if($loggedIn == $_GET['userId']){echo('<a href="../php/EditUser.php?userId='.$_SESSION['userId'].'"><button>Edit user</button></a>');} ?>
            <h3><?php echo($userName);?></h3>
            <div id="body_page_bottom_profiles_div">
                <?php
                $count = 0;
                $class = "body_page_bottom_profiles_profile_div";
                if($profiles != null){
                    foreach($profiles as &$profile){
                        echo('<a href="../php/Profile.php?profileId='.$profile[0].'"><div class="body_page_bottom_profiles_profile_div"><h3>'.$profile[2].'</h3></div></a>');
                        $count++;
                    }
                }else{
                    echo('<a><div class="'.$class.'"><h3>No profiles</h3></div></a>');
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>