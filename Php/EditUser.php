<?php 
require "../php/header.php";
require "../includes/GetUser.inc.php";

// Things that must be defined
$userId = $_GET['userId'];
$loggedIn = null;
$user = null;
$userDir = null;
$userPfpSrc = null;
$userUid = null;

// Verification
if(empty($userId)){
    header("Location: ../php/Home.php");
    exit();
}else{
    if(!isset($_SESSION['login']) || $_SESSION['login'] == ""){
        header("Location: ../php/Home.php");
        exit();
    }else{
        if($userId != $_SESSION['userId']){
            header("Location: ../php/Home.php");
            exit();
        }else{
            $loggedIn = $_SESSION['userId'];
            if(getUserById($loggedIn)['idUsers']!=$loggedIn || $loggedIn!=$userId){
                header("Location: ../php/home.php");
                exit();
            } else {
                //  Post verification code
                //  Get values to populate "edit user" form
                $user = getUserById($_SESSION['userId']);
                $userDir = "../".$usersDir.$userId."/";
                $userPfpSrc = $userDir."pfp/pfp.png";
                $userUid = $user['uidUsers'];
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>VC - Edit user <?php echo('') ?></title>
        <link rel="stylesheet" type="text/css" href="../css/Forms.css">
        <link rel="stylesheet" type="text/css" href="../css/EditUser.css">
    </head>
    <body>
        <div id="body_page_div">
            <div id="body_page_editUser_div">
                <img id="body_page_editUser_img" class='imgs' src="<?php echo($userPfpSrc); ?>">
                <form action="../includes/editUser.inc.php" method="post">
                    <div class="form_divs">
                        <input name="userPfp" type="file">
                        <input name="userUid" type="text" value="<?php echo($userUid); ?>">
                        <button type="submit" name="edituser">Edit user</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>