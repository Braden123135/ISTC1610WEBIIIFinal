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
    <link rel="stylesheet" type="text/css" href="../Css/Forms.css">
</head>
<body>
    <div id="body_page_div">
        <div id="body_createprofile_div">
            <form id="body_createprofile_form" class="forms" method="post" action="../Includes/CreateProfile.inc.php">
                <div id="createprofile_form_div" class="form_divs" style="display:flex;flex-direction:column;">
                    <input name="profileName" type="text" placeholder="Profile name (No special chars)">
                    <textarea name="profileTagline" class="textarea" type="text" placeholder="Profile tagline (special chars of , . or ! only)"></textarea>
                    <h3 class="labeltop" style="border-bottom: none; margin-bottom:0px;">Profile pic</h3>
                    <input name="profilePfp" class="labelbottom" type="file" ALLOW="text/*">
                    <button name="createprofile" type="submit">Create profile</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>