<?php
    include 'crud.php';
	include 'config.php';
	if(isset($_GET['username'])) {
		$username = $_GET['username'];
	}
	if(isset($_GET['id_post'])) {
		$id_post = $_GET['id_post'];
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Send mail</title>
	<link rel='stylesheet' type='text/css' href='style/style-scroll.css'>
	<link rel='stylesheet' type='text/css' href='style/style-text.css'>
	<link rel='stylesheet' type='text/css' href='style/style-background.css'>
	<link rel='stylesheet' type='text/css' href='style/style-explore.css'>
	<link rel='stylesheet' type='text/css' href='style/style-cards.css'>
	<link rel='stylesheet' type='text/css' href='style/style-posts.css'>
</head>

<body>
    <div class="main">
        <div class="header">
            <div>
				<a href="index.php"><img src="images/logo.png" alt="Logo" /></a>
            </div>
        </div>

		<div class="wrapper">
            <form action="" method="post" enctype="multipart/form-data">
                <?php    
                    $sql1 = "SELECT * FROM users WHERE username ='$username' ";
                    $result1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);   
                ?> 

				<div class="row">
					<div class="input-group">
						<h3>Send to: </h3>
						<input type="text" name="emailTo" id="location" value=<?php echo $row1['email'];?> readonly style="width:100%; font-family:cursive">
					</div>
				</div>
				
				<br />
				<div class="input-group textarea">
					<h3>Message: </h3>
					<textarea required id="comment" name="msgEmail" style="width:100%; font-family:cursive"></textarea>
					<input type="hidden" name="id_post_user" value="<?php echo $id_post;?>" />
				</div>
				<br>
                
				<div class="input-group button">
                	<button class="btn" type="submit" name="sendMail" id="save">Send</button>
				</div>
			</form>

		</div>

    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='javascript/main.js'></script> 
    
</body>
</html>