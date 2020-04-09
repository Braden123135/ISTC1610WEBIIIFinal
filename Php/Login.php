<?php
    require "header.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>VC - Login</title>
    <link rel="stylesheet" type="text/css" href="../css/Home.css">
    <link rel="stylesheet" type="text/css" href="../css/Forms.css">
</head>

<body>
    <form class="forms" action="../includes/login.inc.php" method="post">
        <div id="login_form_div" class="form_divs" style="display:flex;flex-direction:column;">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="login">Login</button>
        </div>
        <a href="Signup.php"><button type="button">Create account</button></a>

    </form>

</body>

</html>