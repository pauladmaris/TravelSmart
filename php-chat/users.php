<?php
    session_start();
    include_once "../config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM users u
        INNER JOIN messages m
        WHERE NOT u.unique_id = {$outgoing_id} 
        AND ((m.outgoing_msg_id = u.unique_id and m.incoming_msg_id = {$outgoing_id}) 
        OR (m.incoming_msg_id = u.unique_id and m.outgoing_msg_id = {$outgoing_id}))
        GROUP BY u.unique_id ORDER BY m.msg_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat. Click on their names and start a chat with somebody!";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>