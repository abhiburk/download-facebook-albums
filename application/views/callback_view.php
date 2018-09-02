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
<?php  include_once dirname(__FILE__)."/../../includes/facebook.php"; ?>
    
<form action="<?= BASE_URL.'main' ?>" method="POST" id="formID" />
    <div id="left"></div>
    <div id="right"></div>
    <div id="top"></div>
    <div id="bottom"></div>
    <div class="overlay-loader">
    <div class="loader"></div></div>
    
    <div id="head" align="center">
        <a class="fg_cl hvr-grow">Facebook to GoogleDrive</a>
        <div class="head_card" >
            <input type="checkbox" name="checkboxG1" id="checkboxG1" class="css-checkbox slct_all chk_boxes" />
            <label for="checkboxG1" class="css-label">Select All</label> |
            <input type="submit" name="download_zip" class="download_all_btn" value="Download Selected">
            <input type="submit" name="google_drive" class="move_all_btn" value="Move Selected">
        </div>
    </div><br>
    <div id="container"  class="card-5 container card">
    <?php
    
        $response = $fb->get('/me?fields=name,id,email,albums', $accessToken);
        $user = $response->getGraphuser();
        $userName=$user['name'];
        if(isset($user['albums'])){
        foreach($user['albums'] as $al){
            $albumID=$al['id'];
            $albumName=$al['name'];
            $photos = $fb->get("/$albumID/photos?fields=images&width", $accessToken->getValue())->getGraphEdge()->asArray();
        
            $albums1=array(); 
            $model_box=0;
            foreach($photos as $photo){
                $model_box++;
                $imgUrl=$photo['images'][0]['source'];
                $albums1[] = $imgUrl;
             }
            $albums2[$al['name']]=$albums1;
            $_SESSION['userName'] = $userName;
            $_SESSION['album'] = $albums2;
            ?>
        
        <?php if(count($albums1)>0){ ?>
            <div class="gallery">
                <?php if(count($albums2[$al['name']])){ ?>
                    <a href="<?=base_url();?>callback/gallary/?album=<?= $albumName; ?>">
                        <img src="<?=$albums2[$al['name']][0];?>" alt="<?=$al['name'];?>" width="300" height="200"
                        onclick="openModal();currentSlide(1)" class="hover-shadow">
                    </a>
                <?php } ?>    
                <div class="desc"> 
                <?= $albumName; ?>(<?=count($albums1);?>) <hr>
                    <input type="checkbox" value="<?= $albumName; ?>" name="list[]" id="checkboxG2<?= $albumID; ?>" class="css-checkbox slct_all list<?= $albumID; ?> ckall" />
                    <label for="checkboxG2<?= $albumID; ?>" class="css-label"></label>
                    <a href='#' id='cb_zip<?= $albumID; ?>' class="download_btn">Download</a>
                    <a class="download_btn">|</a>
                    <a href='#' id='cb_drive<?= $albumID; ?>' class="move_btn">Move</a>
                </div>
            </div>
        <?php } ?>

        <script>
        $("#cb_zip<?= $albumID; ?>").click(function(e) {
            $('.ckall').prop('checked', false);
            if((e.target).tagName == 'INPUT') return true; 
            e.preventDefault();
            $(".list<?= $albumID; ?>").prop("checked", !$(".list<?= $albumID; ?>").prop("checked"));
        });
        
        $("#cb_drive<?= $albumID; ?>").click(function(e) {
            $('.ckall').prop('checked', false);
            if((e.target).tagName == 'INPUT') return true; 
            e.preventDefault();
            $(".list<?= $albumID; ?>").prop("checked", !$(".list<?= $albumID; ?>").prop("checked"));
        });
        </script>
        <?php }}else {
            echo 'No Albums Found';
        }  ?>
    </div>
</form>


<script type="text/javascript">
  $('.chk_boxes').click(function() {
      $('.ckall').prop('checked', this.checked);
  });
</script>

<script type="text/javascript">
  $('.download_btn, .move_btn, .download_all_btn, .move_all_btn').click(function() {
      $('.overlay-loader').show();
  });
</script>

<script type="text/javascript">
$(document).ready(function () {
    $( ".download_btn" ).click(function(event) {
      $( "#formID" ).append("<input type='hidden' name='download_zip' value='Download Selected' />");;
      if($(event.target).attr('class') == 'download_btn') 
        $( "#formID" ).submit();
    });

    $( ".move_btn" ).click(function(event) {
      $( "#formID" ).append("<input type='hidden' name='google_drive' value='Move Selected' />");;
      if( $(event.target).attr('class') == 'move_btn') 
        $( "#formID" ).submit();
    });
});
</script>



</body>
</html>