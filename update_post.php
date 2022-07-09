<?php
    include 'crud.php';
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Update Post</title>
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
                <img src='images/logo.png' alt='Logo' />
            </div>

            <div class="navigation">
                <ul class="menu">
                    <li class="li">
                        <a href="index.php">Home</a>  
                    </li>
                    <li class="li">
                        <a href="explore.php"> Explore </a> 
                    </li>
                    <li class="li">
                        <a class="active" href="#">Post</a>
                    </li>
                </ul>
            </div>
        </div>

		<div class="wrapper">
            <form action="" method="post" enctype="multipart/form-data">
                <?php      
                    $sql1 = "SELECT * FROM posts WHERE id_post ='$id_post' ";
                    $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {  
                ?>

				<div class="row">
					<div class="input-group">
						<h3>Location: </h3>
						<input type="text" value="<?php echo $row1['location']; ?>" name="location" id="location" required autocomplete="off">
					</div>
				</div>
				<div class="row">
					<div class="input-group">
						<h3>Tag: </h3>
						<div class="select">
						<select name="tag" id="tag">
    						<option value="<?php echo ucfirst($row1['tag']) ?>"> <?php echo ucfirst($row1['tag']) ?></option>
                            <option disabled value="<?php echo ucfirst($row1['tag']) ?>"> <?php echo ucfirst($row1['tag']) ?> </option>
                            <?php if(ucfirst($row1['tag'])!="Transport") {?><option value="Transport">Transport</option> <?php ;} ?>
                            <?php if(ucfirst($row1['tag'])!="Food") {?><option value="Food">Food</option> <?php ;} ?>
							<?php if(ucfirst($row1['tag'])!="Hotel") {?><option value="Hotel">Hotel</option> <?php ;} ?>
                            <?php if(ucfirst($row1['tag'])!="Attraction") {?><option value="Attraction">Attraction</option> <?php ;} ?>
						</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-group">
					<h3>Choose another image: </h3>
                        <input type="file" accept="image/*" name="img" id="img" style="width: 50%; border-radius: 3px; padding: .7rem 2rem; opacity:0.7; color: #FFF; background: #042f41;" >
                        <input type="hidden" name="old_img" value="<?php echo $row1['photo_name']; ?>">
                    </div>
                </div>
				<br />
				<div class="input-group textarea">
					<h3>Review: </h3>
					<textarea id="comment" name="comment" required style="width:100%; font-family:cursive"><?php echo $row1['comment']; ?> </textarea>
				</div>
				<br>
                <?php
                        }
                    }          
                ?>
				<div class="input-group button">
                	<button class="btn" type="submit" name="edit" id="save">Save & Post</button>
				</div>

			</form>

		</div>

    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='javascript/main.js'></script> 
</body>
</html>