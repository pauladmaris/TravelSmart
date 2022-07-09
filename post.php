<?php 
    include 'crud.php'
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Post</title>
	<link rel='stylesheet' type='text/css' href='style/style-scroll.css'>
	<link rel='stylesheet' type='text/css' href='style/style-slideshow.css'>
	<link rel='stylesheet' type='text/css' href='style/style-text.css'>
	<link rel='stylesheet' type='text/css' href='style/style-background.css'>
	<link rel='stylesheet' type='text/css' href='style/style-explore.css'>
	<link rel='stylesheet' type='text/css' href='style/style-cards.css'>
	<link rel='stylesheet' type='text/css' href='style/style-posts.css'>
</head>

<body>
	<?php $len = 10; ?>
	<div class="main">
		<div class="header">
			<div>
				<a href="index.php"><img src="images/logo.png" alt="Logo" /></a>
			</div>

			<div class="navigation">
				<ul class="menu">
					<li class="li first">
						<a href="index.php"> Home </a>  
					</li>
					<li class="li">
						<a href="explore.php"> Explore </a> 
					</li>
					<li class="li">
						<a class="active" href="#"> Post </a>
					</li>
					<li class="li-right">
						<button id="logout_button"><a href="post.php?logout='1'"><i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
					</li>   
				</ul>
			</div>
		</div>

		<a href="#posts-section">
			<div id="scroll-section" class="scroll-section">
				<div class="ctn-title">
					<p id="p1">Scroll To My Posts</p>
				</div>

				<a href="#posts-section" class="ctn-icon">
					<i class="fa fa-hand-o-down" aria-hidden="true"></i>
				</a>
			</div>
		</a>

		<h2 style="font-family:cursive;">Welcome <strong> <?php echo $_SESSION['username']; ?> </strong> </h2> <br>

		<!-- loading animation -->
		<div id="loadingDiv" style="display:none;">
			<div style="display:flex;justify-content:center;align-items:flex-end;">
				<div class="loading" style="--duration:2s;--num-dot:10;">
					<div style="--index:0"></div>
					<div style="--index:1"></div>
					<div style="--index:2"></div>
					<div style="--index:3"></div>
					<div style="--index:4"></div>
					<div style="--index:5"></div>
					<div style="--index:6"></div>
					<div style="--index:7"></div>
					<div style="--index:8"></div>
					<div style="--index:9"></div>
				</div>
			</div>
		</div>
		<div class="wrapper">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="input-group">
						<h3>Location: </h3>
						<input type="text" name="location" id="location" placeholder="Enter the city" required autocomplete="off" style="width:100%; font-family:cursive">
					</div>
				</div>
				<div class="row">
					<div class="input-group">
						<h3>Tag: </h3>
						<div class="select">
						<select name="tag" id="tag" required>
							<option selected disabled value="">Choose an option</option>
							<option value="Transport">Transport</option>
							<option value="Food">Food</option>
							<option value="Hotel">Hotel</option>
							<option value="Attraction">Attraction</option>
						</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-group">
						<h3>Type: </h3>
						<div class="select">
						<select name="person_type" id="person_type" required>
							<option selected disabled value="">Choose an option</option>
							<option value="Traveler">Traveler </option>
							<option value="Local">Local</option>
						</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-group">
					<h3>Choose an image: </h3>
						<input type="file" accept="image/*" name="img" id="img" style="width: 50%; border-radius: 3px; padding: .7rem 2rem; opacity:0.7; color: #FFF; background: #042f41;" required>
					</div>
				</div>
				<br />
				<div class="input-group textarea">
					<h3>Review: </h3>
					<textarea id="comment" name="comment" placeholder="Enter your comment" required style="width:100%; font-family:cursive"></textarea>
				</div>
				<br>
				<div class="input-group button">
					<button onclick="showLoadingAnimation()" class="btn" type="submit" name="submit" style="margin: 20px 0; display: block; padding: .7rem 2rem; color: #FFF; background: #0084b8; border:none; outline:none; border-radius:3px; cursor: pointer; font-size:1rem">Post</button>
				</div>
			</form>
		</div>

		<!--- My posts section-->
		<div id="posts-section" class="posts-section"> </div>

		<div class="slideshow-container3">

			<button class="prev3 active" id="prev3" onclick="showPosts()">My Posts</button>
			<span class="between">/</span>
			<button class="next3" id="next3" onclick="showFavs()">Favourite posts</button>

			<div class="mySlides3" id="posts" style="display:block;">
				<div class="container" >
					<div class="row mt-5">
						<?php      
							$sql = "SELECT * FROM posts WHERE username ='{$_SESSION['username']}' ORDER BY id_post DESC ";
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {  
								if(mysqli_num_rows($result) < 3) { ?>
								<div class="col" id="one">
							<?php } 
							else { ?>
								<div class="col"> <?php } ?>

							<div class="card">
								<div class="main-box">
									<?php echo "<td> <img src='uploads/".$row['photo_name']."' /> </td>"; ?>
									
									<div class="overlay" >
										<div style="margin-top:25%;"> </div>
										<a href="update_post.php?id_post=<?php echo $row['id_post']; ?>"><button type="submit" name="edit" id="edit"> <i class="fa fa-pencil" aria-hidden="true"></i></button></a>
										<!-- delete button starts here here -->
										<form id="delete" method="post" action="" >
											<input type="hidden" name="id_post" value="<?php print $row['id_post']; ?>"/> 
											<button type="submit" name="delete" id="delete" > <i class="fa fa-trash" aria-hidden="true"></i> </button>  
										</form>
									</div>
								</div>
								
								<div class="card-body">
									<p class="date-author">
										<?php echo $row['date'];?> <i class="fa fa-calendar" aria-hidden="true"></i>
										<span class="author">By <?php echo $row['username']; ?> </span>
										<span class="person_type">
											<?php if($row['person_type']==='traveler') { ?>
												<img class="traveler" src="images/traveler.png" > 
											<?php } ?>
											<?php if($row['person_type']==='local') { ?>
												<img class="local" src="images/local.png" >
											<?php } ?>
										</span>
									</p> 
									
									<div class="slideshow">
										<div class="slideshow-container">
											<?php 
											$len2 = intdiv(strlen($row['comment']),105) + 1;
											$newtext = $row['comment'] . " ";
											$init_pos = 0;
											if ($len2 == 1) { ?>
												<div class="mySlides" >
													<?php echo $row['comment']; ?>
												</div>
											<?php } else  
											for($i = 0; $i < $len2; $i++) { ?>
													<div class="mySlides">
														<?php 
															$substr = substr($newtext,$init_pos,105);
															$pos = strrpos($substr,' ',-1);            //last space before 80 chars.
															echo substr($newtext,$init_pos,$pos);
															$init_pos = $init_pos + $pos + 1;
														?>
													</div>
											<?php }  if ($len > 1 ) {
												if($len2 == 1){ ?>
													<a class="prev" id="prevWhite">❮</a>
													<a class="next" id="nextWhite">❯</a> 
												<?php } else {?>        
													<a class="prev">❮</a>
													<a class="next">❯</a>
											<?php } } ?>
										</div>

										<?php if($len > 1) {
											if($len2 == 1){ ?> 
											<div class="dot-container">
													<span class="dot" id="dotWhite"></span> 
											</div>
											<?php } else {?>
											<div class="dot-container">
												<?php for($i = 0; $i < $len2; $i++) { ?>
													<span class="dot"></span> 
												<?php } ?>
											</div>
										<?php } }?>
									</div>
									
									<p class="date-author">
										<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $row['location'];?> 
										<?php if($row['tag']==='food') {?> <span class="author" id="foodTag" > <b> #<?php echo $row['tag']; ?> </b></span> <?php }?>
										<?php if($row['tag']==='hotel') {?> <span class="author" id="hotelTag" > <b> #<?php echo $row['tag']; ?> </b></span> <?php }?>
										<?php if($row['tag']==='transport') {?> <span class="author" id="transportTag" > <b> #<?php echo $row['tag']; ?> </b></span> <?php }?>
										<?php if($row['tag']==='attraction') {?> <span class="author" id="attractionTag" > <b> #<?php echo $row['tag']; ?> </b></span> <?php }?>
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
							$sql = "SELECT * FROM favposts WHERE unique_id ='{$_SESSION['unique_id']}' ORDER BY id_post DESC ";
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) == 0) { ?>
							<h3>Still no favourite posts..</h3>
							<?php } else {
								while ($row = mysqli_fetch_assoc($result)) {  
									$sql2 = "SELECT * FROM posts WHERE id_post = {$row['id_post']} ";
									$result2 = mysqli_query($conn, $sql2);
									if (mysqli_num_rows($result2) > 0) {
										while ($row2 = mysqli_fetch_assoc($result2)) { 
											if(mysqli_num_rows($result2) < 3) {
							?>
								<div class="col" id="one"><?php } 
							else { ?>
								<div class="col"><?php } ?>
							
							<div class="card">
								<div class="main-box">
								<?php echo "<td> <img src='uploads/".$row2['photo_name']."' /> </td>"; ?>
								
								<div class="overlay" >
									<div style="margin-top:25%;"> </div>
									<!-- delete button starts here -->
									<form id="deleteFav" method="post" action="" >
										<input type="hidden" name="id_post_fav" value="<?php print $row2['id_post']; ?>"/> 
										<button type="submit" name="deleteFav" id="deleteFav"><img class="notFavImg" src="images/not-fav.png" /> </button>  
									</form>
							
								</div>
							</div>

							<div class="card-body">
									<p class="date-author">
										<?php echo $row2['date'];?> <i class="fa fa-calendar" aria-hidden="true"></i>
										<span class="author">By <?php echo $row2['username']; ?> </span>
										<span class="person_type">
											<?php if($row2['person_type']==='traveler') { ?>
												<img class="traveler" src="images/traveler.png" > 
											<?php } ?>
											<?php if($row2['person_type']==='local') { ?>
												<img class="local" src="images/local.png" >
											<?php } ?>
										</span>
									</p> 
									
									<div class="slideshow">
										<div class="slideshow-container">
											<?php 
											$len2 = intdiv(strlen($row2['comment']),100) + 1;
											$newtext = $row2['comment'] . " ";
											$init_pos = 0;
											if ($len2 == 1) { ?>
												<div class="mySlides" >
													<?php echo $row2['comment']; ?>
												</div>
											<?php } else  
											for($i = 0; $i < $len; $i++) { ?>
													<div class="mySlides">
														<?php 
															$substr = substr($newtext,$init_pos,100);
															$pos = strrpos($substr,' ',-1);            //last space before 80 chars.
															echo substr($newtext,$init_pos,$pos);
															$init_pos = $init_pos + $pos + 1;
														?>
													</div>
											<?php }  if ($len > 1 ) {
												if($len2 == 1){ ?>
													<a class="prev" id="prevWhite">❮</a>
													<a class="next" id="nextWhite">❯</a> 
												<?php } else {?>        
													<a class="prev">❮</a>
													<a class="next">❯</a>
											<?php } } ?>
										</div>

										<?php if($len > 1) {
											if($len2 == 1){ ?> 
											<div class="dot-container">
													<span class="dot" id="dotWhite"></span> 
											</div>
											<?php } else {?>
											<div class="dot-container">
												<?php for($i = 0; $i < $len2; $i++) { ?>
													<span class="dot"></span> 
												<?php } ?>
											</div>
										<?php } }?>
									</div>
									
									<p class="date-author">
										<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $row2['location'];?> 
										<?php if($row2['tag']==='food') {?> <span class="author" id="foodTag" > <b> #<?php echo $row2['tag']; ?> </b></span> <?php }?>
										<?php if($row2['tag']==='hotel') {?> <span class="author" id="hotelTag" > <b> #<?php echo $row2['tag']; ?> </b></span> <?php }?>
										<?php if($row2['tag']==='transport') {?> <span class="author" id="transportTag" > <b> #<?php echo $row2['tag']; ?> </b></span> <?php }?>
										<?php if($row2['tag']==='attraction') {?> <span class="author" id="attractionTag" > <b> #<?php echo $row2['tag']; ?> </b></span> <?php }?>
									</p>
								</div>
							</div>
						</div>
							
						<?php
								}
							}    
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

