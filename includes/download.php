<?php

if($_POST['download_zip'] && isset($_POST['list'])){

    $lists=$_POST['list'];
    $albums = $_SESSION['album']; 
    foreach($albums as $key=>$a ){
        if (!in_array($key,$lists)){
            unset($albums[$key]);
        }    
    }
    $_SESSION['album']=$albums;

    $date=date('Y_m_d_h_m_s');
    # create new zip object
    $zip = new ZipArchive();

    # create a temp file & open it
    $zipname_location = "uploads/".$_SESSION['userName']."_$date.zip";
    $zipname_location = str_replace(' ', '_', $zipname_location);
    $zip->open($zipname_location, ZipArchive::CREATE);

    foreach($albums as $albumName => $images){
        $dir='master/'.$albumName;

        # loop through each file
        foreach ($images as $file) {
            # download file
            $download_file = file_get_contents($file);
            
            $result = strstr($file, '.jpg', true);
            $newName=$result.'.jpg';
            
            #add it to the zip
            $zip->addFromString($dir.'/'.basename($newName),$download_file);
        }

    }
    
    # close zip
    $zip->close();
   
    unset($_SESSION['album']);
    session_destroy($_SESSION['album']);
    header("location:".BASE_URL."?zip_callback=1&download_url=".BASE_URL."$zipname_location");exit;
    # send the file to the browser as a download
    //header('Content-disposition: attachment; filename="My Album_'.$date.'.zip"');
    //header('Content-type: application/zip');
    
    //readfile($tmp_file);
    //unlink($tmp_file);
}