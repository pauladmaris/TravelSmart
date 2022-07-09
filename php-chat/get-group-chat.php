<?php 
    session_start();
    error_reporting(0); // For not showing any error
    
    include_once "../config.php";
    $unique_id = $_SESSION['unique_id'];
    $output = "";
    $msg_location = $_SESSION['msg_location'];
    
    $sql = "SELECT * FROM group_messages WHERE location = '$msg_location' ORDER BY id_group_msg";   //smth WRONG here
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $sql2 = "SELECT * FROM users WHERE unique_id = {$row['unique_id_msg']} ";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            $output .= '<p class="msg">' . $row2['username'] . ': ' . $row['msg'] . '</p> ';
        }
    } else {
        $output .= '<h3> No messages are available. You can start the conversation.</h3>';
    }
    echo $output;
?>