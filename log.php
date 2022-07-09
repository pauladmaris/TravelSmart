<?php 
    include('server.php');
    error_reporting(0);
    
    if(isset($_GET['unique_id'])) {
        $unique_id = $_GET['unique_id'];
        $sql = "UPDATE users SET confirmation = 'true' WHERE unique_id = '$unique_id'";
        $result = mysqli_query($conn, $sql);  
    } 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Log in</title>
    <link rel='stylesheet' type='text/css' href='style/style-login-register.css'>
    <link rel='stylesheet' type='text/css' href='style/style-background.css'>
    <link rel='stylesheet' type='text/css' href='style/style-animations.css'>
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>

<body>
    <div class="header">
        <div>
            <a href="index.php"><img src="images/logo.png" alt="Logo" /></a>
        </div>
        
        <div class="container">
            <div class="card">
                <div class="card__header">
                    <h2 class="title">Log <span>in</span></h2>
                </div>
                <form method="post" action="log.php" >
                    <div class="card__body">
                        <!-- display validation errors here -->
                        <?php include('errors.php');?>
                        <br>
                        <label for="username">Username</label>
                        <input type="text" placeholder="your username" name="username" required autocomplete="off">
                        <label for="password">Password</label>
                        <div class="input-icons">
                            <input type="password" placeholder="your password" id="password-field" name="password" required>
                            <span class="icon"><i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPasswordLog()"></i></span>
                        </div>
                        <div id="confirmationCode" style="display:none;">
                            <label for="username">Code</label>
                            <input type="text" placeholder="confirmation code" name="code" autocomplete="off">
                        </div>
                    </div>

                    <div class="card__footer">
                        <button type="submit" name="login" id="login" class="btn_log-in-up">Log In</button>
                        <p> Don't have an account? <a class="two" href="register.php">Sign Up</a>.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='https://code.jquery.com/jquery-3.3.1.js'></script>
    <script src='javascript/main.js'></script> 

</body>
</html>
