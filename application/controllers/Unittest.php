<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnitTest extends CI_Controller {

    public function sample_test(){
        $this->load->library('unit_test');
        $test = 1 + 1;
        $expected_result = 2;
        $test_name = 'Adds one plus one';
        echo $this->unit->run($test, $expected_result, $test_name);
    }

    public function album_list(){
        if(isset($_SESSION['album'])){
            $albums=$_SESSION['album'];
            if(isset($_POST['list'])){
                $lists=$_POST['list'];
                if(isset($list)){
                    echo 'List';
                    //print_r($lists);
                }else{
                    echo 'Empty List';
                }
                
            }
        }else{
            echo 'Session not available for album';    
        }

        
    }

    public function selected_album(){
        $albums=$_SESSION['album'];
        if(isset($_POST['list'])){
            $lists=$_POST['list'];
            foreach($albums as $key=>$a ){
                if (!in_array($key,$lists)){
                    unset($albums[$key]);
                    echo "Key does not exist!.$key.'</br>'";
                } 
            }
            $_SESSION['album']=$albums;
            if($albums!=$_SESSION['album']){
                echo 'True';
                //print_r($_SESSION['album']);
            }else{
                echo 'False';
            }
           
        }
    }
    

}