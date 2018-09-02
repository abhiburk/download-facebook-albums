<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    
	public function index(){
		
        //$login_details=html_escape($this->input->post());
		$url_array = explode('?', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$url = $url_array[0];
        $rtnURL = BASE_URL;
        
		require_once dirname(__FILE__)."/../../lib/google-api-php-client/src/Google_Client.php";
		require_once dirname(__FILE__)."/../../lib/google-api-php-client/src/contrib/Google_DriveService.php";

		$client = new Google_Client();
		$client->setClientId(GOOGLE_CLIENT_ID);
		$client->setClientSecret(GOOGLE_CLIENT_SECRET_ID);
		$client->setRedirectUri($url);
		$client->setScopes(array('https://www.googleapis.com/auth/drive'));
		if (isset($_GET['code'])) {
			$_SESSION['accessToken'] = $client->authenticate($_GET['code']);
			header('location:'.$rtnURL);exit;
		} elseif (!isset($_SESSION['accessToken'])) {
			$client->authenticate();
		}

		if (!empty(isset($_POST['google_drive'])) && isset($_POST['list'])) {
			$client->setAccessToken($_SESSION['accessToken']);
			$service = new Google_DriveService($client);
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$file = new Google_DriveFile();
			$folder = new Google_DriveFile();

			$lists=$_POST['list'];
			$albums = $_SESSION['album']; 
			foreach($albums as $key=>$a ){
				if (!in_array($key,$lists)){
					unset($albums[$key]);
				}   
			}
			$_SESSION['album']=$albums;

			$albums = $_SESSION['album']; 
			$userName = $_SESSION['userName'];
			
			/*Creating Root Folder Here */
			$folder_mime = "application/vnd.google-apps.folder";
			$folder_name = strtolower('facebook_'.$userName.'_albums');
			$folder->setTitle($folder_name);
			$folder->setMimeType($folder_mime);
			$newFolder = $service->files->insert($folder);
			$parentId  = $newFolder['id'];

			foreach($albums as $albumName => $images){

				/*Creating Sub folder */
				$file->setTitle($albumName);
				$file->setDescription('A Project Folder');
				$file->setMimeType('application/vnd.google-apps.folder');

				//Set the ProjectsFolder Parent
				$parent = new Google_ParentReference();
				$parent->setId($parentId); // id of root folder
				$file->setParents(array($parent));

				//create the ProjectFolder in the Parent
				$subFolder = $service->files->insert($file, array(
					'mimeType' => 'application/vnd.google-apps.folder',
				));
				$subFolderID=$subFolder['id']; // id of sub folder

				$new_file_name=0;
				foreach($images as $imgName){
					$new_file_name++;
					$file_path = $imgName;
					$file_name=$new_file_name;
					// $mime_type = finfo_file($finfo, $imgName);
					//$file_mime = $mime_type;
					$file_path = $file_path;

					$file = new Google_DriveFile();
					if ($subFolderID != null) {
						$parent = new Google_ParentReference();
						$parent->setId($subFolderID);
						$file->setParents(array($parent));
					}

					$file->setTitle($file_name);
					//$file->setDescription('This is a '.$mime_type.' document');
					//$file->setMimeType($mime_type);
					$service->files->insert(
						$file,
						array(
							'data' => file_get_contents($file_path)
							//,'mimeType' => $mime_type
						)
					);
				} 
			}
			//finfo_close($finfo);
			unset($_SESSION['album']);
			unset($_SESSION['userName']);
			header('location:'.$rtnURL.'?google_callback=1');exit;

		}else if(isset($_POST['download_zip']) && isset($_POST['list'])){
			include_once dirname(__FILE__)."/../../includes/download.php";
		}else{
			echo 'Please Select at least 1 album';
		}
    }    


}
        