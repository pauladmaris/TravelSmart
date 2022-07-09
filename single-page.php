<?php 
    include 'operations.php';

    $_SESSION['msg_location'] = $_GET['location'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Location</title>
    <link rel='stylesheet' type='text/css' href='style/style-slideshow.css'>
    <link rel='stylesheet' type='text/css' href='style/style-scroll.css'>
    <link rel='stylesheet' type='text/css' href='style/style-explore.css'>
    <link rel='stylesheet' type='text/css' href='style/style-cards.css'>
    <link rel='stylesheet' type='text/css' href='style/style-chat.css'>
    <link rel='stylesheet' type='text/css' href='style/style-background.css'>
    <link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
   
</head>

<body>
    <div class="main">
        <div class="header">
            <div>
                <img src="images/logo.png" alt="Logo" />
            </div>

            <nav class="navigation">
                <ul class="menuAdmin">
                    <li class="li" style="padding-top:8px;margin-right:10px;">
                    <?php if (substr($_SESSION['username'],0,6) === "admin_") { ?>
                        <a href="admin.php" style="margin-left:0;"><i  class="fa fa-arrow-left"></i></a>  
                    <?php } else {?>
                        <a href="explore.php" style="margin-left:0;"><i  class="fa fa-arrow-left"></i></a>  
                    <?php }?>
                    </li>
                    <li class="li">
                        <a class="active" href="#"> <?php echo $_GET['location']; ?> </a> 
                    </li>   
                </ul>
            </nav>
        </div>

        <div class="container">
            <button class="showBtn" onclick="showGroupChat()">
                <div id="scroll-section" class="scroll-section" style="display:block;">
                    <div class="ctn-title">
                        <p id="p2"> Join group chat</p>
                    </div>

                    <a class="ctn-icon">
                        <i class="fa fa-comments" aria-hidden="true"></i>
                    </a>
                </div>
            </button>

            <div class="row mt-5">
                <?php    
                    $sql = "SELECT * FROM cities WHERE location = '{$_GET['location']}'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) == 0) { ?>
                        <h2 style="font-family:cursive;"> Details about <?php echo $_GET['location'];?> not available.. </h2>
                        <script> document.getElementById("scroll-section").style.display = "none"; </script>
                    <?php } else {
                    while ($row = mysqli_fetch_assoc($result)) { 
                        if ($row['link'] === "") {?>
                            <h2 style="font-family:cursive;"> Details about <?php echo $_GET['location'];?> not available.. </h2>
                            <script> document.getElementById("scroll-section").style.display = "none"; </script>
                    <?php } else { ?>
                        <div class="col-location">
                            <div class="card">
                                <div class="main-box">
                                    <iframe src=<?php echo $row['link'];?> width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    <a class="weatherwidget-io" href=<?php echo $row['weather'];?> data-label_1 = <?php echo strtoupper($row['location']);?> data-label_2="WEATHER" data-theme="original">WEATHER</a>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <a href="<?php echo $row['link_food'];?>" class="styleA">
                            <div class="card">
                                <div class="main-box">
                                    <?php echo "<td> <img src='uploads/".$row['image_food']."' /> </td>"; ?>
                                </div>
                                <div class="card-body">
                                    <p class="date-author">
                                        <span class="author" style="color:black;"> <?php echo $row['food']; ?> </span>
                                        <br>
                                        <span class="author" style="color:green;"> <b> #mustEat </b></span> 
                                    </p>
                                </div>
                            </div>
                            </a>
                        </div>

                        <div class="col">
                            <a href="<?php echo $row['link_attraction1'];?>" class="styleA">
                            <div class="card">
                                <div class="main-box">
                                    <?php echo "<td> <img src='uploads/".$row['image_attraction1']."' /> </td>"; ?>
                                </div>
                                <div class="card-body">
                                    <p class="date-author">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i><span class="author" style="color:black;"> <?php echo $row['attraction1']; ?> </span>
                                        <br>
                                        <span class="author"> <b> #mustVisit </b></span> 
                                    </p>
                                </div>
                            </div>
                            </a>
                        </div>

                        <div class="col">
                            <a href="<?php echo $row['link_attraction2'];?>" class="styleA">
                            <div class="card">
                                <div class="main-box">
                                    <?php echo "<td> <img src='uploads/".$row['image_attraction2']."' /> </td>"; ?>
                                </div>
                                <div class="card-body">
                                    <p class="date-author">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i><span class="author" style="color:black;"> <?php echo $row['attraction2']; ?> </span>
                                        <br>
                                        <span class="author"> <b> #mustVisit </b></span> 
                                    </p>
                                </div>
                            </div>
                            </a>
                        </div>
                        
                    <?php
                            }
                        }  
                    }        
                    ?>
            </div>
    
        </div>

        <!--- Group chat section-->
        <div id="groupChat" style="display:none;">
            <div class="chatHeader"> <h2 id="chatTitle"> Welcome to <?php echo $_GET['location'] ?> group chat </h2> </div>
            <div class="chatBox" id="chat-section"> </div>
            
            <!--- If the user is an admin or isn't logged in at all, disable chatFooter -->
            <?php if (substr($_SESSION['username'],0,6) === "admin_" or !isset($_SESSION['unique_id'])) { ?>
                <div style="display:none; margin-bottom:100px;">
            <?php } ?> 

            <div class="chatFooter">
                <form id="groupChatForm" action="#" class="group-typing-area"> 
                    <textarea name="group_msg" class="group_msg_field" placeholder="Write something..." required></textarea>
                    <input type="hidden" name="msg_location" class="msg_location" value="<?php echo $_GET['location'];?>" >
                    <button> <i class="fa fa-paper-plane" aria-hidden="true"></i> </button>
                </form>
            </div>
            <?php if (substr($_SESSION['username'],0,6) === "admin_" or !isset($_SESSION['unique_id'])) { ?>
                </div>
            <?php }  ?> 

            <?php if (!isset($_SESSION['unique_id'])) {?>
                <div class="warningLogIn"> <p> Want to write something here? <a href="log.php"> Log in</a> first! </p> </div>
            <?php } ?>
            
        </div>
           
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='https://code.jquery.com/jquery-3.3.1.js'></script>
    <script src='javascript/main.js'></script>
    <script src='javascript/group-chat.js'></script>

    <!-- script for weather link -->
    <script>
        !function(d,s,id) {
            var js,fjs = d.getElementsByTagName(s)[0];
            if(!d.getElementById(id)){
                js = d.createElement(s);
                js.id = id;
                js.src='https://weatherwidget.io/js/widget.min.js';
                fjs.parentNode.insertBefore(js,fjs);
            }
        }(document,'script','weatherwidget-io-js');
    </script>
</body>

</html>