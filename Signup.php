<?php
    require "header.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css" type="text/css">
</head>

<body>
    <form action="includes/signup.inc.php" method="post">
        <div id="signup_form_div" class="form_divs">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Verify password">
            <button type="submit" name="signup">Signup</button>
        </div>
    </form>
</body>

</html>