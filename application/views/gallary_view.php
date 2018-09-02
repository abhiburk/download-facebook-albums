<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Album Gallary</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="<?=base_url('assets/css/style.css');?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {
    display:none;
}
</style>
</head>
<body>
<?php
    $model=$_SESSION['album'];
    $select=$_GET['album'];
    foreach($model as $key=>$a ){
        if($key==$select){
            //$m[$key]=$model[$key];
            $_SESSION['model']=$model[$key];
        }
    }
?>
<h2 class="w3-center">
    <a href="<?=$_SESSION['loginURL'];?>"><img src="<?=base_url('assets/img/back.png');?>" width="25"  />
        back
    </a> | 
<?=$select;?></h2>
<div class="w3-content w3-display-container">
        <?php 
            $model_box=0;
            $url=$_SESSION['model'];
            foreach($url as $img =>$val){
            $model_box++;
        ?>
            <img class="mySlides w3-animate-left" src="<?=$val;?>" >
        <?php } ?>
  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>


</body>
</html>