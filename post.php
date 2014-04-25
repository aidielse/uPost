<?php
require_once 'config.php';
session_start();

//This script will receive an ajax request from the user
//Check if it is a POST Request
//And return a json formated response
header('Content-Type: application/json');

//Current POST format, if all ssns are selected: Array(text=>"", facebook=>"on", twitter=>"on", google+=>"on", lat=>Num, long=>Num, location=>"on") 
if(!empty($_POST))
{
	//Check to see if the user is logged in to the SSN they are posting to by checking the xx_access_token. 
	//print_r($_SESSION);
	
	//If there's any unset access token, let the user know 
	//print_r($_POST);
	
	
	//Validation that the user is logged in with all the ssns he chose to post to
	//...
	//...
	
	if(isset($_POST['twitter']))
	{
		//Get a user-specific connection object that 
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION["tw_access_token"], $_SESSION["tw_access_token_secret"]);
		$status = $connection->post('statuses/update', array('status' => $_POST['text'], 'lat' =>$_POST['lat'], 'long'=>$_POST['long'], 'display_coordinates'=>$_POST['location'] ));
		echo json_encode(array("success"=>1, "status"=>$status));
		die();
	}
	
	if($_SESSION['login']=='facebook' && isset($_SESSION['fb_access_token'])) {}
	
	else if($_SESSION['login']=='googleplus' && $_SESSION['g+_is_logged_in'] == "ye") {}
	
	else if($_SESSION['login']=='twitter' && isset($_SESSION['tw_access_token'])){}
	
	else {header("Location: http://{$host}/");}
	
}
?>