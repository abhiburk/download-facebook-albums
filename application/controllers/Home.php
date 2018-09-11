<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		require_once dirname(__FILE__)."/../../lib/Facebook/autoload.php";
		$fb = new Facebook\Facebook([
            'app_id' => FB_APP_ID, 
            'app_secret' => FB_SECRET_ID,
            'default_graph_version' => 'v2.2',
			]);
			
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email','user_photos']; 
		$_SESSION['loginURL'] = $helper->getLoginUrl(BASE_URL.'callback/', $permissions);
		
		$this->load->view('home_view');
	}

	public function logout()
	{
		if(isset($accessToken)){
			require_once dirname(__FILE__)."/../../lib/Facebook/autoload.php";
			$url = 'https://www.facebook.com/logout.php?next='.BASE_URL.'&access_token='.$accessToken; 
			session_destroy();
		}
		echo 'Sessions Destroyed';
		
	}

}
