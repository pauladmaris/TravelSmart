<?php 
    session_start();
    error_reporting(0); // For not showing any error
    include_once "../config.php";
    
    $msg = mysqli_real_escape_string($conn, $_POST['group_msg']); // Get Msg from form
    $location = mysqli_real_escape_string($conn,$_POST['msg_location']); // Get Location from form
    $unique_id = $_SESSION['unique_id']; // Get Unique_id from SESSION
    $sql = mysqli_query($conn, "INSERT INTO group_messages (location, unique_id_msg, msg)
        VALUES ('$location', '$unique_id', '$msg')") or die(); 
?>