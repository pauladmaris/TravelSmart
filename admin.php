<?php 
    include 'crud.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>AdminPosts</title>
    <link rel='stylesheet' type='text/css' href='style/style-slideshow.css'>
    <link rel='stylesheet' type='text/css' href='style/style-explore.css'>
    <link rel='stylesheet' type='text/css' href='style/style-cards.css'>
    <link rel='stylesheet' type='text/css' href='style/style-background.css'>
    <link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
    <link rel='stylesheet' type='text/css' href='style/style-chat.css'>
    
</head>

<body>
<?php $len = 10;?>

<div class="column">
    <div class="main">
        <div class="header">
            <div>
                <img src="images/logo.png" alt="Logo" />
            </div>

            <nav class="navigation">
                <ul class="menuAdmin">
                    <li class="li">
                        <a class="active" href="admin.php">All Posts</a>
                    </li>
                    <li class="li">
                        <a href='admin-post.php'>Locations</a>
                    </li>
                    <li class="li-right">
                        <button id="logout_button"><a href="post.php?logout='1'"><i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
                    </li>                  
                </ul>
            </nav>
        </div>
        
        <br> <br>
        
        <?php include 'search.php';
            $nr_posts = 0;
        ?>
        <div class="container" >
            <div class="row mt-5">
                <?php include 'filter.php';
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) == 0) { ?>
                        <h2 style="font-size:1.5em"> No results found..</h2>
                    <?php }
                    else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if(mysqli_num_rows($result) < 3) { ?>
                                <div class="col" id="one"> <?php } 
                            else { ?>
                    <div class="col">
                    <?php } ?>
                        <div class="card">
                            <div class="main-box">
								<?php echo "<td> <img src='uploads/".$row['photo_name']."' /> </td>"; ?>
								
								<div class="overlay" >
									<div style="margin-top:25%;"> </div>
									<a href="admin_update_post.php?id_post=<?php echo $row['id_post'];?>"><button type="submit" name="editAdmin" id="edit" > <i class="fa fa-pencil" aria-hidden="true"></i></button></a>
									<!-- delete button starts here here -->
									<form id="deleteAdmin" method="post" action="">
										<input type="hidden" name="id_post" value="<?php print $row['id_post']; ?>"/> 
										<button type="submit" name="deleteAdmin" id="delete"> <i class="fa fa-trash" aria-hidden="true"></i> </button>  
									</form>
							
								</div>
							</div>
                            
                            <div class="card-body">
                                <p class="date-author">
                                 	<?php echo $row['date'];?> <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <span class="author"><a class="styleA" href="mail.php?username=<?php echo $row['username'];?>&id_post=<?php echo $row['id_post'];?>">By <?php echo $row['username']; ?></a> </span> 
                                    <span class="person_type"> 
										<?php if($row['person_type']==='traveler') { ?>
											<div class="tooltip">
                                                <img class="traveler" src="images/traveler.png" > 
                                                <span class="tooltiptext">Traveler</span>
                                            </div>
										<?php } ?>
										<?php if($row['person_type']==='local') { ?>
											<div class="tooltip">
                                                <img class="local" src="images/local.png" >
                                                <span class="tooltiptext">Local</span>
                                            </div>
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
                                        if($len2 == 1) { ?> 
                                        <div class="dot-container">
                                                <span class="dot" id="dotWhite"></span> 
                                        </div>
                                        <?php } else { ?>
                                        <div class="dot-container">
                                            <?php for($i = 0; $i < $len2; $i++) { ?>
                                                <span class="dot"></span> 
                                            <?php } ?>
                                        </div>
                                    <?php } 
                                    } ?>
                                </div>

                                <p class="date-author">
                                    <a style="font-size:16px; color:black;" href="single-page.php?location=<?php echo $row['location'];?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $row['location'];?></a>
                                    <?php if($row['tag']==='food') {?> <span class="author" style="font-style:italic; color:green"> <b> #<?php echo $row['tag']; ?> </b></span> <?php }?>
                                    <?php if($row['tag']==='hotel') {?> <span class="author" style="font-style:italic; color:red"> <b> #<?php echo $row['tag']; ?> </b></span> <?php }?>
                                    <?php if($row['tag']==='transport') {?> <span class="author" style="font-style:italic; color:blue"> <b> #<?php echo $row['tag']; ?> </b></span> <?php }?>
                                    <?php if($row['tag']==='attraction') {?> <span class="author" style="font-style:italic; color:violet"> <b> #<?php echo $row['tag']; ?> </b></span> <?php }?>
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
    <script src='https://code.jquery.com/jquery-3.3.1.js'></script>
    <script src='javascript/text-effect.js'></script>
    <script src='javascript/users.js'></script>
    <script src='javascript/main.js'></script>
    <script src='javascript/chat.js'></script>
</body>

</html>