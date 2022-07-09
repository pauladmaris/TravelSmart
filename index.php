<!DOCTYPE html>
<html>
    
<head>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Home</title>
    <link rel='stylesheet' type='text/css' href='style/style-explore.css'>
    <link rel='stylesheet' type='text/css' href='style/style-animations.css'>
    <link rel='stylesheet' type='text/css' href='style/style-background.css'>
</head>
<body>
    <div class="main">
        <div class="header">
            <div>
                <img src="images/logo.png" alt="Logo" />
            </div>

            <nav class="navigation">
                <ul class="menu">
                  <li class="li first">
                      <a class="active" id="first" href="#"> Home </a>  
                  </li>
                  <li class="li">
                      <a href="explore.php"> Explore </a> 
                  </li>
                  <li class="li last">
                      <a href="post.php">Post</a>
                  </li>
                 </ul>
            </nav>
        </div>

        <br> <br>
        <h1 class="textIndex"> Welcome </h1>

        <br> 
        <h2 class="textIndex"> Are you planning to travel soon? </h2>
        <br>

        <a class="animated-arrow" href='Explore.php'>
          <span class="the-arrow -left">
            <span class="shaft"></span>
          </span>
          <span class="main">
            <span class="text">
              EXPLORE
            </span>
            <span class="the-arrow -right">
              <span class="shaft"></span>
            </span>
          </span>
        </a>
        <br> <br>

        <h2 class="textIndex"> Do you want to share your experiences? </h2>
        <br>

        <a class="animated-arrow" href='log.php'>
            <span class="the-arrow -left">
              <span class="shaft"></span>
            </span>
            <span class="main">
                <span class="text">
                  LOGIN
                </span>
                <span class="the-arrow -right">
                  <span class="shaft"></span>
                </span>
            </span>
        </a>   
    </div>

  <script src='javascript/main.js'></script> 
</body>
</html>