<?php 
    include('server.php');
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Sign up</title>
    <link rel='stylesheet' type='text/css' href='style/style-login-register.css'>
    <link rel='stylesheet' type='text/css' href='style/style-background.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
</head>

<body>
    <div class="header">
        <div>
            <a href="index.php"><img src="images/logo.png" alt="Logo" /></a>
        </div>


        <div class="container">
            <div class="card">
                <div class="card__header">
                    <h2 class="title">Sign <span>up</span></h2>
                </div>

                <form method="post" action="register.php" >
                    <div class="card__body">
                        <!-- display validation errors here -->
                        <?php include('errors.php');?>
                        <br>
                        <label for="firstname">First name</label>
                        <input type="text" placeholder="Anne" name="firstname" required autocomplete="off">
                        <label for="username">Username</label>
                        <div class="wrap-username-and-type">
                            <input type="text" placeholder="anne19" id="usernameInput" name="username" required autocomplete="off">
                            <select class="selectStyle" name="user_type" id="user_type" required>
                                <option value="0">Traveler</option>
                                <option value="1">Admin</option>>
                            </select>
                        </div>
                        <label for="email">Email Address</label>
                        <input type="email" placeholder="anne@gmail.com" name="email" required autocomplete="off">
                        <label for="password">Password</label>
                        <div class="input-icons">
                            <input type="password" placeholder="your password" id="password-field2" name="password" required>
                            <span class="icon"><i id="pass-status2" class="fa fa-eye" aria-hidden="true" onClick="viewPasswordSign()"></i></span>
                        </div>
                    </div>

                    <div id="signupform"></div>
                    <div class="card__footer">
                        <button type="submit" name="register" class="btn_log-in-up">Sign Up</button>
                    </div>
                </form>
                        
                <div class="card__footer">
                    <p> Already a user?<a class="two" href="log.php"><b> Log in</b></a></p>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='https://code.jquery.com/jquery-3.3.1.js'></script>
    <script src='javascript/main.js'></script> 
</body>
</html>