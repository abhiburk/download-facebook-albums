<?php
    include_once dirname(__FILE__)."/../lib/Facebook/autoload.php";
    $fb = new Facebook\Facebook([
        'app_id' => FB_APP_ID, 
        'app_secret' => FB_SECRET_ID,
        'default_graph_version' => 'v2.2',
        ]);

    $jsHelper = $fb->getJavaScriptHelper();
    // @TODO This is going away soon
    $facebookClient = $fb->getClient();

    //require_once(BASE_URL.'lib/Facebook/autoload.php');
    $helper = $fb->getRedirectLoginHelper();
    if (isset($_GET['state'])) { 
        $helper->getPersistentDataHandler()->set('state', $_GET['state']); 
    }
    try {
        $accessToken = $jsHelper->getAccessToken($facebookClient);
        //$accessToken = $helper->getAccessToken(BASE_URL.'callback/');
        //$accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    if (! isset($accessToken)) {
        if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
        } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
        }
        exit;
    }