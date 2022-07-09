<?php 
include 'config.php';
include 'PHPMailer/PHPMailerAutoload.php';
session_start();

error_reporting(0); // For not showing any error

$msg = "";

//if there is an user logged in: 
if (isset($_SESSION['unique_id'])) { 
    $unique_id = $_SESSION['unique_id']; 
} 

//if the user wants to log out
if (isset($_GET['logout'])) { 
    session_destroy();
    unset($_SESSION['username']);
    header("location:log.php");
}

//if there is no user logged in:
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: log.php');
}


//ADD POST:
if (isset($_POST['submit'])) {
    $tag = $_POST['tag']; // Get Tag from form
    $person_type = $_POST['person_type']; // Get Type from form
    $username = $_SESSION['username']; // Get Username from SESSION
    $unique_id = $_SESSION['unique_id']; // Get Unique_id from SESSION
    $location = mysqli_real_escape_string($conn, $_POST['location']); // Get Location from form
    $comment = mysqli_real_escape_string($conn, $_POST['comment']); // Get Comment from form

    $img_name = rand() . $_FILES['img']['name'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    $img_size = $_FILES['img']['size'];

    $date = date("d M, Y");

    if ($img_size > 15242880) {
        $msg = "<div class='alert alert-danger'>Image is too big. Maximum image uploading size is 15 MB.</div>";
    } 
    else {
        //check database for existing user with same posts
        $user_check_query = "SELECT * FROM posts WHERE username = '$username' and comment = '$comment' and location = '$location' LIMIT 1";
        $result1 = mysqli_query($conn, $user_check_query);
        $post = mysqli_fetch_assoc($result1);

        if($post) {
            $msg = "<div class='alert alert-danger'>There is already a similar post. </div>";
        }
        else {
            $sql = "INSERT INTO posts (comment, location, photo_name, username, date, tag, person_type, unique_id)
                VALUES ('$comment', '$location', '$img_name', '$username','$date', '$tag', '$person_type', '$unique_id')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sql_id_post = "SELECT id_post FROM posts WHERE username='$username' AND comment='$comment' AND location='$location' AND date='$date' AND tag='$tag' ";
                $result_id_post = mysqli_query($conn, $sql_id_post);
                $row_id_post = mysqli_fetch_assoc($result_id_post);
                $id_post = $row_id_post['id_post'];
                move_uploaded_file($img_tmp_name, "uploads/" . $img_name);
                $_POST['comment'] = "";
                $_POST['tag'] = "";
                $_POST['person_type'] = "";
                $_POST['username'] = "";
                $_POST['location'] = "";
                $msg = "<div class='alert alert-success'>Post added successful.</div>";
                $sql2 = "INSERT INTO cities (location, link,food,image_food,weather,attraction1,image_attraction1,attraction2,image_attraction2,link_food,link_attraction1,link_attraction2)
                    VALUES ('$location', '','','','','','','','','','','')";
                $result2 = mysqli_query($conn, $sql2);

                //check database for admin users to send them notification that post has been added
                /* $user_check_admin = "SELECT * FROM users WHERE user_type = '1' ";
                $result3 = mysqli_query($conn, $user_check_admin);
                if (mysqli_num_rows($result3) > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) { 
                        $sentTo = $row3['email'];
                        $mail = new PHPMailer;
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'travelsmartnow24.7';                      // SMTP username
                        $mail->Password = 'TravelSmartNow24.7';                       // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
                        $mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
                        $mail->setFrom('travelsmartnow24.7@gmail.com', 'Travel Smart ADMIN');     //Set who the message is to be sent from
                        $mail->addAddress($sentTo);                           // Add a recipient
                        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = "Travel Smart - New Post Added - ";
                        $mail->Body    = "<div style='padding: 10px; border-radius: 10px; height: auto; background-image:linear-gradient(to right, rgba(287, 202, 192), rgba(142, 65, 98));opacity:0.8;'><h2 style='font-family:cursive'> Hello " . $row3['username'] . "</h2> <br> <a href='localhost/one-post.php?id_post=$id_post'><button style='color:white; background:black; pointer: cursor; padding: 10px; border-radius: 20px;'> See post</button></a><br></div>";
                        $mail->AltBody = $message;

                        if(!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                            exit;
                        }
                    }
                } */
                header("location:post.php#posts-section");
            } else {
                $msg = "<div class='alert alert-danger'>Something wrong went. Please try again later.</div>";
            } 
        }
    } 
}

// for update_post.php
if (isset($_GET['id_post'])) {
    $id_post = $_GET['id_post'];
} 

//UPDATE POST: 
if (isset($_POST['edit'])) {
    $tag = $_POST['tag']; 
    $username = $_SESSION['username']; 
    $location = mysqli_real_escape_string($conn, $_POST['location']); 
    $comment = mysqli_real_escape_string($conn, $_POST['comment']); 

    $img_name = rand() . $_FILES['img']['name'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    $img_size = $_FILES['img']['size'];
    $old_img = $_POST['old_img'];

    if($_FILES['img']['size'] == 0) {
        $sql = "UPDATE posts SET comment='$comment', location='$location', tag='$tag', photo_name='$old_img', username='$username' WHERE id_post='$id_post'";
        $result = mysqli_query($conn, $sql);
        header("location:post.php#posts-section");
    }
    else {
        if ($img_size > 15242880) {
            $msg = "<div class='alert alert-danger'>Image is too big. Maximum image uploading size is 15 MB.</div>";
        } else {
            $sql = "UPDATE posts SET comment='$comment', location='$location', tag='$tag', photo_name='$img_name', username='$username' WHERE id_post='$id_post'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                move_uploaded_file($img_tmp_name, "uploads/" . $img_name);
                $msg = "<div class='alert alert-success'>Post updated successful.</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Something wrong went. Please try again later.</div>";
            }
            header("location:post.php#posts-section");
        }
    }
}


//DELETE POST:
if(isset($_POST['delete'])){
    $id = $_POST['id_post'];  
    $query = "DELETE FROM posts WHERE id_post = $id"; 
    $result = mysqli_query($conn, $query);
    header("location:post.php#posts-section");
}

//DELETE FAVOURITE POST:
if(isset($_POST['deleteFav'])){
    $id = $_POST['id_post_fav'];  
    $query = "DELETE FROM favposts WHERE id_post = $id AND unique_id = {$_SESSION['unique_id']}"; 
    $result = mysqli_query($conn, $query);
    header("location:post.php#posts-section");
}

//------------------------------------------------------------ ADMIN OPERATIONS:  -----------------------------------------------------

//DELETE POST:
if(isset($_POST['deleteAdmin'])){
    $id = $_POST['id_post'];  
    $query = "DELETE FROM posts WHERE id_post = $id"; 
    $result = mysqli_query($conn, $query);
    header("location:admin.php");
}

//UPDATE POST: 
if (isset($_POST['editAdmin'])) {
    $tag = $_POST['tag']; 
    $username = $_POST['user-username']; 
    $location = mysqli_real_escape_string($conn, $_POST['location']); 
    $comment = mysqli_real_escape_string($conn, $_POST['comment']); 

    $img_name = rand() . $_FILES['img']['name'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    $img_size = $_FILES['img']['size'];
    $old_img = $_POST['old_img'];

    if($_FILES['img']['size'] == 0) {
        $sql = "UPDATE posts SET comment='$comment', location='$location', tag='$tag', photo_name='$old_img' WHERE id_post='$id_post'";
        $result = mysqli_query($conn, $sql);
        header("location:admin.php");
    }
    else {
        if ($img_size > 15242880) {
            $msg = "<div class='alert alert-danger'>Image is too big. Maximum image uploading size is 15 MB.</div>";
        } else {
            $sql = "UPDATE posts SET comment='$comment', location='$location', tag='$tag', photo_name='$img_name', username='$username' WHERE id_post='$id_post'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                move_uploaded_file($img_tmp_name, "uploads/" . $img_name);
                $msg = "<div class='alert alert-success'>Post updated successful.</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Something wrong went. Please try again later.</div>";
            }
            header("location:admin.php");
        }
    }
}


/* if (isset($_POST['sendMail'])) {
    $message = $_POST['msgEmail'];
    $sentTo = $_POST['emailTo'];
    $id_post = $_POST['id_post_user'];

    $mail = new PHPMailer;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'travelsmartnow24.7';                      // SMTP username
    $mail->Password = 'TravelSmartNow24.7';                       // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
    $mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
    $mail->setFrom('travelsmartnow24.7@gmail.com', 'Travel Smart ADMIN');     //Set who the message is to be sent from
    $mail->addAddress($sentTo);  // Add a recipient
    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Travel Smart - Post reviewed by Admin";
    $mail->Body    = "<p><b>". $message."</b></p>";
    $mail->AltBody = $message;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    }

    header("location:admin.php");
} */

//ADD POST:
if (isset($_POST['addInfo'])) {
    $location = mysqli_real_escape_string($conn, $_POST['location']); // Get Location from form
    $link = mysqli_real_escape_string($conn, $_POST['link']); // Get Map Link from form
    $food = mysqli_real_escape_string($conn, $_POST['food']); // Get Food name from form
    $attraction1 = mysqli_real_escape_string($conn, $_POST['attraction1']); 
    $attraction2 = mysqli_real_escape_string($conn, $_POST['attraction2']); 
    $weather = mysqli_real_escape_string($conn, $_POST['weather']); // Get Weather Link from form
    $link_food = mysqli_real_escape_string($conn, $_POST['link_food']); // Get Food Link from form
    $link_attraction1 = mysqli_real_escape_string($conn, $_POST['link_attraction1']); // Get Attraction1 Link from form
    $link_attraction2 = mysqli_real_escape_string($conn, $_POST['link_attraction2']); // Get Attraction2 Link from form

    //food
    $img_name = rand() . $_FILES['img']['name'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    $img_size = $_FILES['img']['size'];

    //attraction 1
    $img_name1 = rand() . $_FILES['img1']['name'];
    $img_tmp_name1 = $_FILES['img1']['tmp_name'];
    $img_size1 = $_FILES['img1']['size'];

    //attraction 2
    $img_name2 = rand() . $_FILES['img2']['name'];
    $img_tmp_name2 = $_FILES['img2']['tmp_name'];
    $img_size2 = $_FILES['img2']['size'];
    if ($img_size2 > 15242880) {
        $msg = "<div class='alert alert-danger'>Image is too big. Maximum image uploading size is 15 MB.</div>";
    } 
    else {
        //check database for existing location
        $user_check_query = "SELECT * FROM cities WHERE location = $location LIMIT 1";
        $result1 = mysqli_query($conn, $user_check_query);
        $post = mysqli_fetch_assoc($result1);

        if($post) {
            $msg = "<div class='alert alert-danger'>There is already a similar post. </div>";
        }
        else {
            $sql = "INSERT INTO cities (location, link, food, image_food, weather, attraction1, image_attraction1, attraction2, image_attraction2, link_food, link_attraction1, link_attraction2)
                VALUES ('$location', '$link', '$food', '$img_name', '$weather', '$attraction1', '$img_name1', '$attraction2', '$img_name2', '$link_food', '$link_attraction1', '$link_attraction2')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                move_uploaded_file($img_tmp_name, "uploads/" . $img_name);
                move_uploaded_file($img_tmp_name1, "uploads/" . $img_name1);
                move_uploaded_file($img_tmp_name2, "uploads/" . $img_name2);
                $_POST['link'] = "";
                $_POST['weather'] = "";
                $_POST['location'] = "";
                $_POST['food'] = "";
                $_POST['attraction1'] = "";
                $_POST['attraction2'] = "";
                $_POST['link_food'] = "";
                $_POST['link_attraction1'] = "";
                $_POST['link_attraction2'] = "";
                $msg = "<div class='alert alert-success'>Post added successful.</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Something wrong went. Please try again later.</div>";
            } 
            header("location:admin-post.php#posts-section");
        }
    }
}

// for update_location_admin.php
if (isset($_GET['id_city'])) {
    $id_city = $_GET['id_city'];
} 

//UPDATE LOCATION: 
if (isset($_POST['editLocation'])) {
    $location = mysqli_real_escape_string($conn, $_POST['location']); 
    $link = mysqli_real_escape_string($conn, $_POST['link']); 
    $food = mysqli_real_escape_string($conn, $_POST['food']); 
    $attraction1 = mysqli_real_escape_string($conn, $_POST['attraction1']); 
    $attraction2 = mysqli_real_escape_string($conn, $_POST['attraction2']); 
    $weather = mysqli_real_escape_string($conn, $_POST['weather']); 
    $link_food = mysqli_real_escape_string($conn, $_POST['link_food']); 
    $link_attraction1 = mysqli_real_escape_string($conn, $_POST['link_attraction1']); 
    $link_attraction2 = mysqli_real_escape_string($conn, $_POST['link_attraction2']); 

    $img_name = rand() . $_FILES['img']['name'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    $img_size = $_FILES['img']['size'];
    $old_img = $_POST['old_img'];

    $img_name1 = rand() . $_FILES['img1']['name'];
    $img_tmp_name1 = $_FILES['img1']['tmp_name'];
    $img_size1 = $_FILES['img1']['size'];
    $old_img1 = $_POST['old_img1'];

    $img_name2 = rand() . $_FILES['img2']['name'];
    $img_tmp_name2 = $_FILES['img2']['tmp_name'];
    $img_size2 = $_FILES['img2']['size'];
    $old_img2 = $_POST['old_img2'];

    if($_FILES['img']['size'] == 0 && $_FILES['img1']['size'] != 0 && $_FILES['img2']['size'] != 0) {
        $sql = "UPDATE cities SET image_food='$old_img',image_attraction1='$img_name1',image_attraction2='$img_name2', location='$location', link='$link', food='$food', attraction1='$attraction1', attraction2='$attraction2', weather='$weather', link_food='$link_food', link_attraction1='$link_attraction1',link_attraction2='$link_attraction2' WHERE id_city='$id_city' OR location = '{$_GET['location']}'";
    } else if($_FILES['img']['size'] == 0 && $_FILES['img1']['size'] == 0 && $_FILES['img2']['size'] != 0) {
        $sql = "UPDATE cities SET image_food='$old_img',image_attraction1='$old_img1',image_attraction2='$img_name2', location='$location', link='$link', food='$food', attraction1='$attraction1', attraction2='$attraction2', weather='$weather', link_food='$link_food', link_attraction1='$link_attraction1',link_attraction2='$link_attraction2' WHERE id_city='$id_city' OR location = '{$_GET['location']}'";
    } else if($_FILES['img']['size'] == 0 && $_FILES['img1']['size'] != 0 && $_FILES['img2']['size'] == 0) {
        $sql = "UPDATE cities SET image_food='$old_img',image_attraction1='$img_name1',image_attraction2='$old_img2', location='$location', link='$link', food='$food', attraction1='$attraction1', attraction2='$attraction2', weather='$weather', link_food='$link_food', link_attraction1='$link_attraction1',link_attraction2='$link_attraction2' WHERE id_city='$id_city' OR location = '{$_GET['location']}'";
    } else if($_FILES['img']['size'] == 0 && $_FILES['img1']['size'] == 0 && $_FILES['img2']['size'] == 0) {
        $sql = "UPDATE cities SET image_food='$old_img',image_attraction1='$old_img1',image_attraction2='$old_img2', location='$location', link='$link', food='$food', attraction1='$attraction1', attraction2='$attraction2', weather='$weather', link_food='$link_food', link_attraction1='$link_attraction1',link_attraction2='$link_attraction2' WHERE id_city='$id_city' OR location = '{$_GET['location']}'";
    } else if($_FILES['img']['size'] != 0 && $_FILES['img1']['size'] == 0 && $_FILES['img2']['size'] != 0) {
        $sql = "UPDATE cities SET image_food='$img_name',image_attraction1='$old_img1',image_attraction2='$img_name2', location='$location', link='$link', food='$food', attraction1='$attraction1', attraction2='$attraction2', weather='$weather', link_food='$link_food', link_attraction1='$link_attraction1',link_attraction2='$link_attraction2' WHERE id_city='$id_city' OR location = '{$_GET['location']}'";
    } else if($_FILES['img']['size'] != 0 && $_FILES['img1']['size'] != 0 && $_FILES['img2']['size'] == 0) {
        $sql = "UPDATE cities SET image_food='$img_name',image_attraction1='$img_name1',image_attraction2='$old_img2', location='$location', link='$link', food='$food', attraction1='$attraction1', attraction2='$attraction2', weather='$weather', link_food='$link_food', link_attraction1='$link_attraction1',link_attraction2='$link_attraction2' WHERE id_city='$id_city' OR location = '{$_GET['location']}'";
    } else if($_FILES['img']['size'] != 0 && $_FILES['img1']['size'] != 0 && $_FILES['img2']['size'] != 0) {
        $sql = "UPDATE cities SET image_food='$img_name',image_attraction1='$img_name1',image_attraction2='$img_name2', location='$location', link='$link', food='$food', attraction1='$attraction1', attraction2='$attraction2', weather='$weather', link_food='$link_food', link_attraction1='$link_attraction1',link_attraction2='$link_attraction2' WHERE id_city='$id_city' OR location = '{$_GET['location']}'";
    } else if($_FILES['img']['size'] != 0 && $_FILES['img1']['size'] == 0 && $_FILES['img2']['size'] == 0) {
        $sql = "UPDATE cities SET image_food='$img_name',image_attraction1='$old_img1',image_attraction2='$old_img2', location='$location', link='$link', food='$food', attraction1='$attraction1', attraction2='$attraction2', weather='$weather', link_food='$link_food', link_attraction1='$link_attraction1',link_attraction2='$link_attraction2' WHERE id_city='$id_city' OR location = '{$_GET['location']}'";
    }    

    $result = mysqli_query($conn, $sql);
    if ($result) {
        move_uploaded_file($img_tmp_name, "uploads/" . $img_name);
        move_uploaded_file($img_tmp_name1, "uploads/" . $img_name1);
        move_uploaded_file($img_tmp_name2, "uploads/" . $img_name2);
        $msg = "<div class='alert alert-success'>Location updated successful.</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Something wrong went. Please try again later.</div>";
    }
    header("location:admin-post.php#posts-section");
}

//DELETE POST:
if(isset($_POST['deleteLocation'])){
    $id = $_POST['id_city'];  
    $query = "DELETE FROM cities WHERE id_city = $id"; 
    $result = mysqli_query($conn, $query);
}

?>