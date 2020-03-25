<?php

require "header.php";
if(!isset($_SESSION['login']) || $_SESSION['login']==""){
    header("Location: ../php/login.php");
}

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>VC - Create profile</title>
        <link rel="stylesheet" type="text/css" href="../Css/Home.css">
    </head>
    <body>
        <div id="body_page_div">
            <div id="body_createprofileform_div">
                <form id="body_createprofile_form" class="forms" method="post" action="../Includes/CreateProfile.inc.php">
                    <input name="profileName" type="text">
                    <input name="profileTagline" type="text">
                    <button name="createprofile" type="submit">Create profile</button>
                </form>
            </div>
        </div>
    </body>
</html>