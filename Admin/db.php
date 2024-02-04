<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "fragrance_loungue";

// Create connection
$mysqli =new mysqli($servername, $username, $password,$db)or die(mysqli_error($mysqli));

// Check connection
if (!$mysqli) {
 die($mysqli->error);
}


?>
