<?php
require_once 'config.php';
session_start();

//This script will receive an ajax request from the user
//Check if it is a POST Request
//And return a json formated response {'data': xxxx}
//IF an ERROR occurs, it returns a json formated as {'error': 'error type'}
header('Content-Type: application/json');

//Current POST format, if all ssns are selected: Array(text=>"", facebook=>"on", twitter=>"on", googleplus=>"on", lat=>Num, long=>Num, location=>"on") 
if(!empty($_POST))
{
	//print_r($_POST);
	//Check to see if the user is logged in to the SSN they are posting to by checking the xx_access_token. 
	//print_r($_SESSION);
	$all_snss=array("fb_access_token", "tw_access_token", "g+_is_logged_in");
	//A flag that indicates if the user has logged into all the sns selected
	$all_loggedin=true;
	//If there's any unset access token, let the user know by sending the error msg
	
	if(!isset($_SESSION["fb_access_token"]) && ($_POST["facebook"])=="on")
	{
		$all_loggedin=false;
		echo json_encode(array("error"=>"facebook"));
	}
	if(!isset($_SESSION["tw_access_token"]) &&  ($_POST["twitter"]=="on"))
	{
		$all_loggedin=false;
		echo json_encode(array("error"=>"twitter"));
	}
	if(!isset($_SESSION["g+_is_logged_in"]) &&  ($_POST["googleplus"])=="on")
	{
		$all_loggedin=false;
		echo json_encode(array("error"=>"googleplus"));
		
	}
	
	
	if(!$all_loggedin)
	{
		http_response_code(403);
		die();
	}
	
	if(isset($_POST['facebook']))
	{
		// connects to facebook
		$config = array(
    	'appId' => $fb["APPID"],
    	'secret' => $fb["APP_SECRET"],
    	'allowSignedRequest' => false
  	);
  	$facebook = new Facebook( $config );
  	$user_id = $facebook->getUser();
  	if ( isset( $user_id ) ) 
  	{
  		// posts the message
  		try 
  		{
	  		$return = $facebook->api(
	  			'/me/feed',
	  			'POST',
	  			array(
	  				'message' 		  => $_POST["text"],
	  				'access_token'  => $_SESSION["fb_access_token"]
	  			)
	  		);
	  	}
	  	// handles error
	  	catch ( FacebookApiException $e )
	  	{
	  		error_log( "Caught exception " . $e );
        error_log( $e->getType() );
        error_log( $e->getMessage() );
	  	}
  	}
	}
	
	if(isset($_POST['twitter']))
	{
		//Get a user-specific connection object that 
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION["tw_access_token"], $_SESSION["tw_access_token_secret"]);
		$status = $connection->post('statuses/update', array('status' => $_POST['text'], 'lat' =>$_POST['lat'], 'long'=>$_POST['long'], 'display_coordinates'=>$_POST['location'] ));
		echo json_encode(array("success"=>1, "status"=>$status));
		die();
	}
	
	if(isset($_POST['googleplus']))
	{
		//posting to Google plus
	}
	
	if($_SESSION['login']=='facebook' && isset($_SESSION['fb_access_token'])) {}
	
	else if($_SESSION['login']=='googleplus' && $_SESSION['g+_is_logged_in'] == "ye") {}
	
	else if($_SESSION['login']=='twitter' && isset($_SESSION['tw_access_token'])){}
	
	else {header("Location: http://{$host}/");}
	
}
?>