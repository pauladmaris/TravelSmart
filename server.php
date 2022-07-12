
<?php 
    include 'PHPMailer/PHPMailerAutoload.php';
    error_reporting(0); // For not showing any error
    session_start();

    //Initialising variables
    $firstname = "";
    $username = "";
    $email = "";
    $errors = array();
    $password = "";
    $code = 0;
    $unique_id = 0;


    //connect to the database
    $conn = mysqli_connect('localhost','root','','travelsmart') or die("could not connect to database");

    //if the confirmation button is clicked
    if(isset($_POST['register'])) {
        //receive all input values from the form
        $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $ran_id = rand(time(), 100000000);
        $user_type = mysqli_real_escape_string($conn,$_POST['user_type']);
        $confirmation = "true"; //$confirmation = "false";
        if ($user_type === "1") {
            $username = "admin_" . $username;
        }
        if (empty($firstname)) {
            array_push($errors, "First name is required");
        }
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        //check database for existing user with same username
        $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if($user) {
            if($user['username'] === $username) {array_push($errors,"Username already exists");}
            if($user['email'] === $email) {array_push($errors,"This email has a registered username");}
        } else {
            
        //Register the user if no error
        // if(count($errors) == 0) {
        //     $sentTo = $email;
        //     $message = "Confirm registration";
        //     $mail = new PHPMailer;

        //     //$mail->SMTPDebug = 2;

        //     $mail->isSMTP();                                      // Set mailer to use SMTP
        //     $mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
        //     $mail->SMTPAuth = true;                               // Enable SMTP authentication
        //     $mail->Username = 'travelsmartnow24.7';                      // SMTP username
        //     $mail->Password = 'TravelSmartNow24.7';                       // SMTP password
        //     $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        //     $mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
        //     $mail->setFrom('travelsmartnow24.7@gmail.com', 'Travel Smart ADMIN');     //Set who the message is to be sent from
        //     $mail->addAddress($sentTo);                           // Add a recipient
        //     $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        //     $mail->isHTML(true);                                  // Set email format to HTML

        //     $mail->Subject = "Travel Smart - Confirm Registration - ";
        //     $mail->Body    = "
        //     <div style='padding: 10px; border-radius: 10px; height: auto; background-image:linear-gradient(to right, rgba(287, 202, 192), rgba(142, 65, 98));opacity:0.8;'>
        //         <h2 style='font-family:cursive'> WELCOME TO Travel Smart! </h2> 
        //         <br> 
        //         <a href='localhost/log.php?unique_id=$ran_id' style='color:white; background:black; pointer: cursor; padding: 10px; border-radius:20px; font-family:cursive; text-decoration:none;'> Confirm registration </a>
        //         <h5> PS: If the confirmation button isn't working, type this code in the Log in page: $ran_id.</h5>
        //     </div>";
        //     $mail->AltBody = $message;

        //     if(!$mail->send()) {
        //         echo 'Message could not be sent.';
        //         echo 'Mailer Error: ' . $mail->ErrorInfo;
        //         exit;
        //     }
        
        
        $password = md5($password);
        //save to database
        $query = "INSERT INTO users (unique_id,username,password,email,firstname,user_type,confirmation) VALUES ('$ran_id','$username','$password','$email','$firstname','$user_type','$confirmation')";

        mysqli_query($conn, $query);   
        $_SESSION['unique_id'] = $ran_id;
        $_SESSION['username'] = $user['username'];
        $_SESSION['success'] = "You are now registered!";
        header("location: log.php"); }

        //if user is an admin, send him instructions for log in and other
        /* if($user_type === "1") {
            $sentTo = $email;
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

            $mail->Subject = "Travel Smart - Instructions - ";
            $mail->Body    = "
            <div style='padding: 10px; border-radius: 10px; height: auto; background-image:linear-gradient(to right, rgba(287, 202, 192), rgba(142, 65, 98));opacity:0.8;'>
                <h2 style='font-family:cursive'> WELCOME TO Travel Smart! </h2> 
                <br> 
                <b>
                Because you're an admin, here are a couple of instructions:
                <br>
                1.) Username = ". $username . "
                <br>
                2.) Everytime a new post is added, please check if it's relative content, otherwise send an email to the user by clicking on his name. If no changes are made in the next hour, you can edit the post yourself!
                <br>
                3.) Check constantly the Locations Page for locations without informations. If you have to add info, here is a guide:
                <br>
                - copy paste the map link from Google Maps (<a href='https://www.google.com/maps'>Link Google Maps</a>) => example: https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d107318.9622392185!2d34.94673507971613!3d32.799747206238116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151dba4c750de845%3A0xc35d23982a81529a!2sHaifa%2C%20Israel!5e0!3m2!1sro!2sro!4v1638092377524!5m2!1sro!2sro
                <br>
                - copy paste the weather link from WeatherWidget (<a href='https://weatherwidget.io/'>Link Weather Widget</a>) => example: https://forecast7.com/en/32d7934d99/haifa/
                <br>
                - for food, search for a traditional dish (upload a photo) and copy the link from a good restaurant where you can eat this.
                <br>
                - for attractions, search for 2 popular places (in the city or nearby), upload the photos and copy the links of their websites. 
                <br>
                - Also, very important: check if the locations are cities!!
                </b>
            </div>";
            $mail->AltBody = "Sorry, details are not available";

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;
            }
        } */
        //}
	}


    //if the login button is clicked
    if(isset($_POST['login'])) {
        //receive all input values from the form
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);   
        $code = '0';    
        $password = md5($password); //encrypt password before comparing with the one from the database
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $confirmation = $row['confirmation'];
            $code = mysqli_real_escape_string($conn,$_POST['code']); 
            if($row['confirmation'] == 'true' || $code == $row['unique_id']) {
                $query = "UPDATE users SET confirmation='true' WHERE username = '$username' AND password = '$password' ";
                $result = mysqli_query($conn, $query);
                $_SESSION['username'] = $username;
                $_SESSION['unique_id'] = $row['unique_id'];
                $_SESSION['success'] = "You are now logged in";
                if(substr($username, 0, 6) === "admin_") {
                    header('location: admin.php');
                } else {
                    header('location: post.php');
                }
            }
            else { ?>
                <!-- log in popup: email not confirmed -->
                <div class="popup2 code" id="code_confirmation">
                    <button id="upBtn" onclick="closeConfirmation()"><i class="fa fa-window-close" aria-hidden="true"></i></button>
                    <div class="message"> 
                        <div class="containerEffect">
                            <p> Please check your email and confirm registration!</p>
                            <br>
                            <p style="color:white"> OR </p> 
                            <br>
                            <button id="typeCode" onclick="openTypeCode()"> Type code</button>
                        </div>
                    </div>
                </div>
            <?php }
            }
        else {
            array_push($errors,"Wrong username or password.. ");
        }
	}

    //logout
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: index.php');
    }
?>
