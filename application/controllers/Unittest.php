<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unittest extends CI_Controller {

    public function sample_test(){
        $this->load->library('unit_test');
        $test = 1 + 1;
        $expected_result = 2;
        $test_name = 'Adds one plus one';
        echo $this->unit->run($test, $expected_result, $test_name);
    }

    

}