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

<div class="main">
    <div class="header">
        <div>
            <img src="images/logo.png" alt="Logo" />
        </div>
        <div class="navigation">
            <ul class="menu" style="justify-content:center;">
                <li class="li">
                	<a href='admin.php'> <i class="fa fa-arrow-left" aria-hidden="true"></i>  </a>  
                </li> 
            </ul>
        </div>
    </div>

    <div class="container" >
        <div class="row mt-5">
            <?php      
                $sql = "SELECT * FROM posts WHERE id_post ='{$_GET['id_post']}' ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col"> 
                        <div class="card">
							<div class="main-box">
								<?php echo "<td> <img src='uploads/".$row['photo_name']."' /> </td>"; ?>	
							</div>
							
							<div class="card-body">
                                <p class="date-author">
                                 	<?php echo $row['date'];?> <i class="fa fa-calendar" aria-hidden="true"></i>
                                     <span class="author"><a class="styleA" href="mail.php?username=<?php echo $row['username'];?>&id_post=<?php echo $row['id_post'];?>">By <?php echo $row['username']; ?></a> </span> 
									<span class="person_type">
										<?php if($row['person_type']==='traveler') { ?>
											<img class="traveler" src="images/traveler.png" > 
										<?php } ?>
										<?php if($row['person_type']==='local') { ?>
											<img class="local" src="images/local.png" >
										<?php } ?>
									</span>
                                </p> 

                                <div class="ex1">
                                    <p class="card-text">
                                    <textarea cols="30" readonly><?php echo $row['comment']; ?> </textarea> 
                                    </p> 
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

</body>
</html>