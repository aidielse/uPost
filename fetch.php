<?php
require_once 'config.php';
session_start();

header('Content-Type: application/json');

if(!empty($_GET))
{
	$res=array("success"=>1, "data"=>array(), "error"=>array());
	if(isset($_SESSION['fb_access_token'])) {
		try{
			// connects to facebook
			$config = array(
					'appId' => $fb["APPID"],
					'secret' => $fb["APP_SECRET"],
					'allowSignedRequest' => false
			);
			$facebook = new Facebook( $config );
			$user_id = $facebook->getUser();
			$return = $facebook->api(
					'/me/home',
					'GET',
					array(
							'access_token'  => $_SESSION["fb_access_token"]
					)
			);
			$res["data"]["facebook"]=$return["data"];
		}
		catch(Exception $ex)
		{
			http_response_code(403);
			$res["success"]=0;
			array_push($res["error"], "facebook");
		}
	}
	
	if(isset($_SESSION['tw_access_token'])){
		try{
			$connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION["tw_access_token"], $_SESSION["tw_access_token_secret"]);
			$feeds = $connection->get('statuses/home_timeline', array('count'=>50));
			$res["data"]["twitter"]=$feeds;
		}
		catch(Exception $ex)
		{
			http_response_code(403);
			$res["success"]=0;
			array_push($res["error"], "twitter");
		}
	}
	echo json_encode($res);
}