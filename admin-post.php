<?php 
    include 'crud.php';
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Info</title>
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

        <div class="navigation">
            <ul class="menuAdmin">
                <li class="li" >
                	<a href='admin.php'>All Posts</a>  
                </li>
                <li class="li">
                	<a class='active' href='admin-post.php'>Locations</a>
                </li>
				<li class="li-right">
					<button id='logout_button'><a href="post.php?logout='1'"><i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
            	</li>   
			  
            </ul>
		</div>
	</div>

    <br> <br> <br> <br>
    
    <div id="scroll-section" class="scroll-section">
        <div class="ctn-title">
            <p id='p1'>
            Scroll to All Locations
            </p>
        </div>

        <a href="#posts-section" class="ctn-icon">
            <i class="fa fa-hand-o-down" aria-hidden="true"></i>
        </a>
    </div>
    <br> <br>
    <h2 style="font-family:cursive;">Welcome <strong> <?php echo $_SESSION['username']; ?> </strong> </h2>
    <br>

    <div class="wrapper">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="tooltip2">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
                <span class="tooltiptext">Please check your email for instructions!</span>
            </div>
            <br>
            <div class="row">
                <div class="input-group">
                    <h3>Location: </h3>
                    <?php if(isset($_GET['location'])) {?>
                        <input type="text" name="location" id="location" value=<?php echo $_GET['location'];?> readonly>
                    <?php } else { ?>
                        <input type="text" name="location" id="location" placeholder="Enter the city" required autocomplete="off">
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <h3>Map link: </h3>
                    <input type="text" name="link" id="location" placeholder="Enter the map link" required autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <h3>Weather link: </h3>
                    <input type="text" name="weather" id="location" placeholder="Enter the weather link" required autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <h3>Food name: </h3>
                    <input type="text" name="food" id="location" placeholder="Enter the food name">
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <h3>Food link: </h3>
                    <input type="text" name="link_food" id="location" placeholder="Enter the food link" required autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                <h3>Choose image: </h3>
                    <input type="file" accept="image/*" name="img" id="img" required>
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <h3>First attraction: </h3>
                    <input type="text" name="attraction1" id="location" placeholder="Enter the attraction name">
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <h3>First attraction link: </h3>
                    <input type="text" name="link_attraction1" id="location" placeholder="Enter the link" required autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                <h3>Choose image: </h3>
                    <input type="file" accept="image/*" name="img1" id="img" required>
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <h3>Second attraction: </h3>
                    <input type="text" name="attraction2" id="location" placeholder="Enter the attraction name">
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                    <h3>Second attraction link: </h3>
                    <input type="text" name="link_attraction2" id="location" placeholder="Enter the link" required autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="input-group">
                <h3>Choose image: </h3>
                    <input type="file" accept="image/*" name="img2" id="img" required>
                </div>
            </div>
            <div class="input-group button">
                <button class="btn" type="submit" name="addInfo"> Add info </button>
            </div>
        </form>
    </div>
        
    <!--- My posts section-->
	<div id="posts-section" class="posts-section"> </div>

    <div class="slideshow-container3">
        <button class="prev3 active" id="prev3" onclick="showPosts()">Info added <i class="fa fa-smile-o" aria-hidden="true"></i></button>
        <span class="between">/</span>
        <button class="next3" id="next3" onclick="showFavs()">Without info <i class="fa fa-frown-o" aria-hidden="true"></i></button>

        <div class="mySlides3" id="posts" style="display:block;">
        <div class="container" >
            <div class="row mt-5">
            <?php      
                $sql = "SELECT * FROM cities WHERE link != '' ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {   ?>
                    <div class="col-location">
                        <div class="card">
                            <div class="main-box">
                                <iframe src=<?php echo $row['link']; ?> width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                <div class="overlay" >
                                    <div style="margin-top:5%;"> </div>
                                    <a href="update_location_admin.php?id_city=<?php echo $row['id_city']; ?>"><button type="submit" name="editLocation" id="edit"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                                    <!-- delete button starts here here -->
                                    <form id="delete" method="post" action="" >
                                        <input type="hidden" name="id_city" value="<?php print $row['id_city']; ?>"/> 
                                        <button type="submit" name="deleteLocation" id="delete"> <i class="fa fa-trash" aria-hidden="true"></i> </button>  
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="date-author">
                                    <a class="styleA" href="single-page.php?location=<?php echo $row['location'];?>"><span class="author"><?php echo $row['location']; ?></span></a>
                                </p> 
                            </div>
                        </div>
                    </div>
            <?php
                    }
                }          
            ?>
            </div>
        </div>
        </div>

        <div class="mySlides3" id="favs">
			<div class="container" >
                <div class="row mt-5">
                    <?php      
                        $sql = "SELECT * FROM cities WHERE link = '' ";
                        $result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) == 0) { ?>
						<h3>No locations to add info..</h3>
						<?php } else {
                            while ($row = mysqli_fetch_assoc($result)) {   ?>
                                <div class="col-location">
                                    <div class="card">
                                        <div class="main-box">
                                            <iframe src=<?php echo $row['link']; ?> width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                            <div class="overlay" >
                                                <div style="margin-top:5%;"> </div>
                                                <a href="update_location_admin.php?id_city=<?php echo $row['id_city']; ?>"><button type="submit" name="editLocation" id="edit"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                                                <!-- delete button starts here here -->
                                                <form id="delete" method="post" action="" >
                                                    <input type="hidden" name="id_city" value="<?php print $row['id_city']; ?>"/> 
                                                    <button type="submit" name="deleteLocation" id="delete"> <i class="fa fa-trash" aria-hidden="true"></i> </button>  
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="date-author">
                                                <a class="styleA" href="update_location_admin.php?location=<?php echo $row['location'];?>"><span class="author"><?php echo $row['location']; ?></span></a>
                                            </p> 
                                        </div>
                                    </div>
                                </div>
                        <?php
                                }
                            }          
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
	<script src='javascript/main.js'></script> 
    
</body>
</html>