<?php 

$server = "localhost";
$username = "root";
$password = "";
$database = "travelsmart";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) { // Check Connection
    die("<script>alert('Connection Failed.')</script>");
}

?>