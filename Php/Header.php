<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Header.css" type="text/css">
</head>

<body>
    <div id="header_div" class="headers">
        <div id="header_logo_div">
            <a href="home.php"> <img id="header_logo_img" class="imgs" src="../Rec/Img/Logo/alphaLogo2.png"> </a>
        </div>
        <div id="header_search_div">
            <img id="header_search_img" class="imgs" src="../Rec/Img/Search/alphaSearch.png">
            <input type="text" id="header_search_input" class="inputs">
            <img id="header_searchgo_img" class="imgs" src="../Rec/Img/SearchGo/alphaSearchGo.png">
        </div>
        <div id="header_endmenu_div">
        <?php
            if(isset($_SESSION['userId'])){
                echo '<img id="header_upload_img" class="imgs" src="../Rec/Img/Upload/alphaUpload.png">';
                echo '<a href="profile.php"><img id="header_me_img" class="imgs" src="../Rec/Img/Me/alphaMe.png"> </a>';
                echo '<a href="../includes/logout.inc.php"> <img id="header_logout_img" class="imgs" src="../Rec/Img/Logout/alphaLogout.png"> </a>';
            }
            else{
                echo '<a href="Login.php"> <img id="header_login_img" class="imgs" src="../Rec/Img/Login/alphaLogin.png"> </a>';
            }
        ?> 
        </div>
    </div>
</body>

</html>