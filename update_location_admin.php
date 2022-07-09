<?php 
    include 'crud.php';
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Update</title>
	<link rel='stylesheet' type='text/css' href='style/style-scroll.css'>
	<link rel='stylesheet' type='text/css' href='style/style-slideshow.css'>
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
        </div>

        <div class="wrapper">
            <form action="" method="post" enctype="multipart/form-data">
                <?php      
                    $sql1 = "SELECT * FROM cities WHERE id_city ='$id_city' OR location = '{$_GET['location']}' ";
                    $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {  
                ?>

                <div class="row">
					<div class="input-group">
						<h3>Location: </h3>
                        <input type="text" name="location" id="location" value="<?php echo $row1['location'];?>" readonly>
                    </div>
				</div>
                <div class="row">
					<div class="input-group">
						<h3>Map link: </h3>
						<input type="text" name="link" id="location" value="<?php echo $row1['link']; ?>" required autocomplete="off">
					</div>
				</div>
                <div class="row">
					<div class="input-group">
						<h3>Weather link: </h3>
						<input type="text" name="weather" id="location" value="<?php echo $row1['weather']; ?>" required autocomplete="off">
					</div>
				</div>
                <div class="row">
					<div class="input-group">
						<h3>Food name: </h3>
                        <input type="text" name="food" id="location" value="<?php echo $row1['food']; ?>">
                    </div>
				</div>
                <div class="row">
					<div class="input-group">
						<h3>Food link: </h3>
						<input type="text" name="link_food" id="location" value="<?php echo $row1['link_food']; ?>" required autocomplete="off">
					</div>
				</div>
                <div class="row">
					<div class="input-group">
					<h3>Choose image: </h3>
                        <input type="file" accept="image/*" name="img" id="img">
                        <input type="hidden" name="old_img" value="<?php echo $row1['image_food']; ?>">
                    </div>
                </div>
                <div class="row">
					<div class="input-group">
						<h3>First attraction: </h3>
                        <input type="text" name="attraction1" id="location" value="<?php echo $row1['attraction1']; ?>">
                    </div>
				</div>
                <div class="row">
					<div class="input-group">
						<h3>First attraction link: </h3>
						<input type="text" name="link_attraction1" id="location" value="<?php echo $row1['link_attraction1']; ?>" required autocomplete="off">
					</div>
				</div>
                <div class="row">
					<div class="input-group">
					<h3>Choose image: </h3>
                        <input type="file" accept="image/*" name="img1" id="img">
                        <input type="hidden" name="old_img1" value="<?php echo $row1['image_attraction1']; ?>">
                    </div>
                </div>
                <div class="row">
					<div class="input-group">
						<h3>Second attraction: </h3>
                        <input type="text" name="attraction2" id="location" value="<?php echo $row1['attraction2']; ?>">
                    </div>
				</div>
                <div class="row">
					<div class="input-group">
						<h3>Second attraction link: </h3>
						<input type="text" name="link_attraction2" id="location" value="<?php echo $row1['link_attraction2']; ?>" required autocomplete="off">
					</div>
				</div>
                <div class="row">
					<div class="input-group">
					<h3>Choose image: </h3>
                        <input type="file" accept="image/*" name="img2" id="img">
                        <input type="hidden" name="old_img2" value="<?php echo $row1['image_attraction2']; ?>">
                    </div>
                </div>
				<?php
                    }
                }          
            ?>
            <div class="input-group button">
                <button class="btn" type="submit" name="editLocation" id="updateBtn">Update Map</button>
            </div>            
        </form>
        </div>
    </div>
</body>
</html>