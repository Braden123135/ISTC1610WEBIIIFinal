<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "beweb3final";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection to the db could not be established".mysqli_connect_error());
}