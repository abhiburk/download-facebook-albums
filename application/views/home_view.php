<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to Facebook Photos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="<?=base_url('assets/css/style.css');?>" rel="stylesheet" />
</head>
<body>
  <div id="left"></div>
  <div id="right"></div>
  <div id="top"></div>
  <div id="bottom"></div>
  
<?php 
    if(isset($_GET['google_callback'])==1){ ?>

        <div id="container" class="card-5 card" style="margin-top:2em;">
            <h1 align="center"><img src="assets/img/gd.png" width="100" /></h1>
            <h1 style="color: #36994c;" > Woola !!! </h1>
            <nav>
                <a class="fb_cl hvr-grow">
                Selected files moved to Google Drive<br>
                <a href="<?=$_SESSION['loginURL'];?>"><img src="<?=base_url('assets/img/back.png');?>" width="25" 
                class="hvr-grow"/>back</a>
                <!-- • -->
            </nav>
        </div>

    <?php }else if(isset($_GET['zip_callback'])==1){ ?>
        <div id="container" class="card-5 card" style="margin-top:2em;">
            <h1 align="center"><img src="assets/img/gallery-96.png" width="100" /></h1>
            <h1 style="color: #36994c;" > Woola !!! </h1>
            <nav>
                <a class="fb_cl hvr-grow">
                Here is your zipped album.Grab It Now !!</a><br>
                <a href="<?=$_GET['download_url'];?>"><img src="<?=base_url('assets/img/download-1.png');?>" 
                width="30" class="hvr-grow"/> download</a><br>
                <a href="<?=$_SESSION['loginURL'];?>">
                <img src="<?=base_url('assets/img/back.png');?>" width="18" 
                class="hvr-grow"/><small style="font-size:25px;color:#d0d0d0">back</small></a>
                <!-- • -->
            </nav>
        </div>
    <?php }else { ?>    
        <div id="head" align="center">
            <a class="fg_cl hvr-grow">Facebook to GoogleDrive</a>
        </div>
        <div id="container" class="card-5 card" style="margin-top:2em;">
            <h1><a class="hvr-grow">Welcome to Facebook Photo</a></h1>
            <nav>
                <a href="<?=$_SESSION['loginURL']; ?>" class="fb_cl hvr-grow">
                <img src="assets/img/facebook.png" width="30" /> Login to facebook</a>
            </nav>
        </div>

    <?php } ?>


</body>
</html>