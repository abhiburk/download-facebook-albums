<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to Facebook Photos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <a href="<?=BASE_URL?>callback"><img src="<?=base_url('assets/img/back.png');?>" width="25" 
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
                <a href="<?=BASE_URL?>callback">
                <img src="<?=base_url('assets/img/back.png');?>" width="18" 
                class="hvr-grow"/><small style="font-size:25px;color:#d0d0d0">back</small></a>
                <!-- • -->
            </nav>
        </div>
    <?php }else { ?>    

        <div id="head" align="center">
            <a class="fg_cl hvr-grow">Facebook to GoogleDrive</a><br>
            <small class="fg_cl" id="status" style="font-size: 23px !important;color: #d8d8d8;"></small>
        </div>
        <div id="container" class="card-5 card" style="margin-top:2em;">
            <h1><a class="hvr-grow">Welcome to Facebook Photo</a></h1>
            <nav>
            <!-- <a href="<?=$_SESSION['loginURL']; ?>" class="fb_cl hvr-grow">
                <img src="assets/img/facebook.png" width="30" /> Login to facebook</a> -->
            <!-- <fb:login-button class="fb_cl hvr-grow" scope="public_profile,email,user_photos" onlogin="checkLoginState();"></fb:login-button> -->
            <div class="fb-login-button" scope="public_profile,email,user_photos" onlogin="checkLoginState();" data-max-rows="1" data-size="medium" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>
            </nav>
        </div>
<script src="<?=base_url('assets/js/facebook.js');?>"></script>
<script>
  function redirectHome() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Successful login for: ' + response.name);
        document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
        setTimeout(() => {
            document.getElementById('status').innerHTML =
        'Redirecting to home page ...';
        }, 2000);
        setTimeout(() => {
            window.location.replace("https://localhost/fbalbum/callback");
            //window.location.replace("https://clapdust.com/callback");
        }, 1000);
        
    });
  }
   // This is called with the results from from FB.getLoginStatus().
 function statusChangeCallback(response) {
    
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      redirectHome();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }
  
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
</script>

<?php } ?>
<!-- <div id="status" style=""></div> -->
</body>
</html>