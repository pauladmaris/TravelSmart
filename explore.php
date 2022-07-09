<?php 
    include 'operations.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Explore</title>
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
                    <a href="index.php"><img src="images/logo.png" alt="Logo" /></a>
                </div>

                <nav class="navigation">
                    <ul class="menu">
                        <li class="li first">
                            <a href="index.php" id="first">Home</a>  
                        </li>
                        <li class="li">
                            <a class="active" href='explore.php'> Explore </a> 
                        </li>
                        <li class="li last">
                            <a href="post.php">Post</a>
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
                    <!-- popup for log in -->
                    <div class="popup error" id="error2" style="display:none;">
                        <div class="action">
                            <button onclick="closeError()">Close</button>
                        </div>
                        <div class="message"> 
                            <div class="containerEffect">
                                <p><a id="effectA" href="log.php">Log in </a><span class="typed-text"></span><span class="cursor">&nbsp;</span></p>
                            </div>
                        </div>
                    </div>

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
                                    <?php if($row['unique_id'] != $_SESSION['unique_id']) {?>
                                    <div class="overlay">
                                        <div style="margin-top:25%;"> </div>
                                        <?php if (isset($_SESSION['unique_id'])) {?>
                                        <form target="frame" id="favForm" class="favFormClass" action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_post_fav" value="<?php echo $row['id_post'];?>" />
                                            <button type="submit" name="fav" id="fav" style="background:transparent; border:none; cursor:pointer;"> <i class="fa fa-heart" style="font-size:60px;color:red;" aria-hidden="true"></i></button>
                                        </form>
                                        <?php } else {?>
                                            <button onclick="closeError()" id="fav" style="background:transparent; border:none; cursor:pointer;"> <i class="fa fa-heart" style="font-size:60px;color:red;" aria-hidden="true"></i></button>
                                        <?php } ?>
                                    </div> 
                                    <?php }?>
                                </div>
                                
                                <div class="card-body">
                                    <p class="date-author">
                                        <?php echo $row['date'];?> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php if ($row['unique_id'] != $_SESSION['unique_id']) {?>
                                            <span class="author"><a href="" id="chatLink" onclick="updateURL(<?php echo $row['unique_id']?>)">By <?php echo $row['username']; ?></a> </span>
                                        <?php } else { ?>
                                            <span class="author">By <?php echo $row['username']; ?></a> </span> 
                                        <?php } ?>
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
                                        <a href="single-page.php?location=<?php echo $row['location'];?>" style="font-size:16px;color:gray;"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $row['location'];?> </a>
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
        
    <?php if(isset($_SESSION['unique_id'])) { ?>
        <div class="openChat" >
            <div class="pulsating-circle"></div>
            <a style="color:black" onclick="showCloseUsers()" ><i class="fa fa-comments-o" aria-hidden="true"></i></a>
        </div>

        <div id="users" style="display:none;">
            <div class="wrapper">
                <section class="users">
                <header>
                    <div class="elemNear">
                    <span><img src="images/chat-icon.png"></span>
                    <div class="content">
                        <?php 
                            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                            if(mysqli_num_rows($sql) > 0){
                            $row = mysqli_fetch_assoc($sql);
                        }
                        ?>
                        <div class="details">
                            <span><?php echo $row['firstname'] ?></span>
                        </div>
                    </div>
                    </div>
                    <i class="fa fa-minus" style="cursor:pointer" aria-hidden="true" onclick="showCloseUsers()"></i>
                </header>
                <div class="search">
                    <span class="text">Search user </span>
                    <input type="text" placeholder="Enter name to search...">
                    <button><i class="fa fa-search"></i></button>
                </div> 
                <div class="users-list"></div>
                </section>
            </div>
        </div>

        <?php 
        //for not showing the chat with user himself
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']); 
        if($user_id != 0) { ?>
            <div id="chatArea" style="display:block;" >
                <video id="background-video" autoplay loop muted poster="images/white.jpg">
                    <source src="images/chat-video.mp4" type="video/mp4">
                </video>

                <div class="wrapper-chat">
                    <section class="chat-area">
                    <header>
                        <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                        if(mysqli_num_rows($sql) > 0){
                            $row = mysqli_fetch_assoc($sql);
                        }else{
                            header("location: explore.php#users");
                        }
                        ?>
                        <button onclick="showCloseChat()" class="back-icon"><i class="fa fa-arrow-left"></i></button>
                        <div class="details">
                            <span><?php echo $row['firstname'] ?></span>
                            <button id="closeChat" onclick="closeChat()"><i class="fa fa-window-close" aria-hidden="true"></i></button>
                        </div>
                    </header>

                    <div class="chat-box"></div>

                    <form id="chatForm" action="#" class="typing-area">
                        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                        <button><i class="fa fa-paper-plane-o"></i></button>
                    </form>
                    </section>
                </div>
            </div>
        <?php } 
    } ?>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='https://code.jquery.com/jquery-3.3.1.js'></script>
    <script src='javascript/text-effect.js'></script>
    <script src='javascript/users.js'></script>
    <script src='javascript/main.js'></script>
    <script src='javascript/chat.js'></script>

    <script>
        function updateURL(new_param) {
            window.history.replaceState({}, '','?user_id='+new_param);
            window.location.reload();
        }
    </script>
</body>

<iframe name="frame" style="display:none;"></iframe>
</html>