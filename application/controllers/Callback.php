<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callback extends CI_Controller {

	public function index(){
		$this->load->view('callback_view');
    }
    
    public function gallary(){
        $this->load->view('gallary_view');
    }


}
