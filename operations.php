<?php 
    include 'config.php';
    session_start();

    error_reporting(0); // For not showing any error

    $msg = "";

    //if there is an user logged in: 
    if (isset($_SESSION['unique_id'])) { 
        $unique_id = $_SESSION['unique_id']; 
        $incoming_username = ""; 
    } else { 
        $username = "";
    }

    //FAVOURITE POST: 
    if (isset($_POST['fav'])) {
        $id_post = $_POST['id_post_fav'];       
        $unique_id_user = $_SESSION['unique_id']; 
        //save to database
        $query = "INSERT INTO favposts (unique_id,id_post) VALUES ('$unique_id_user','$id_post')";
        mysqli_query($conn, $query);   
        //header('location : explore.php'); 
    }

?>