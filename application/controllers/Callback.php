<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callback extends CI_Controller {

	public function index(){
		$this->load->view('callback_view');
    }
    
    public function gallary(){
        $this->load->view('gallary_view');
    }

    public function set_session(){
        if(isset($_POST['data'])){
            $_SESSION['album']=json_decode($_POST['data']);
            echo 'Session set successfully';
        }else{
            echo 'Data is not set.';
        }
    }

    public function get_session(){
        echo '<pre>';
        if(isset($_SESSION['album'])){
            print_r($_SESSION['album']);
        }else{
            echo 'Session not available';
        }
        
    }

}
