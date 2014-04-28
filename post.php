<?php
require_once 'config.php';
session_start();

//This script will receive an ajax request from the user
//Check if it is a POST Request
//And return a json formated response {'data': xxxx}
//IF an ERROR occurs, it returns a json formated as {'error': 'error type'}
header('Content-Type: application/json');

//Current POST format, if all ssns are selected: Array(text=>"", facebook=>"on", twitter=>"on", lat=>Num, long=>Num, location=>"on") 
if(!empty($_POST))
{
	//print_r($_POST);
	//Check to see if the user is logged in to the SSN they are posting to by checking the xx_access_token. 
	//print_r($_SESSION);
	
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
	if(!isset($_SESSION["lk_access_token"]) &&  ($_POST["linkedin"]=="on"))
	{
		$all_loggedin=false;
		echo json_encode(array("error"=>"linkedin"));
	}
	
	
	if(!$all_loggedin)
	{
		http_response_code(403);
		die();
	}
	
	//Debugging $_POST
// 	print_r($_POST);
// 	die();
	
	//If succeeded posting to all the ssns, success will be 1, and ssns will be an array of ssns posted to
	//If any posting failedd, success will be 0, and ssns will be an array of ssns posted to with success, and error will be the error type
	$res=array('success'=>1, 'ssns'=>array(), 'error'=>array());
	if($_POST['facebook']=="on")
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
		  		array_push($res['ssns'], 'facebook');
		  	}
		  	// handles error
		  	catch ( FacebookApiException $e )
		  	{
		  		error_log( "Caught exception " . $e );
	        	error_log( $e->getType() );
	        	error_log( $e->getMessage() );
	        	$res['success']=0;
	        	array_push($res['error'],"facebook-posting-failed");
		  	}
	  	}
	  	else
	  	{
	  		$res['success']=0;
	  	}
	}
	
	if($_POST['twitter']=="on")
	{
		//Get a user-specific connection object that 
		try{
			$connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION["tw_access_token"], $_SESSION["tw_access_token_secret"]);
			$status = $connection->post('statuses/update', array('status' => $_POST['text'], 'lat' =>$_POST['lat'], 'long'=>$_POST['long'], 'display_coordinates'=>$_POST['location'] ));
			
			array_push($res['ssns'], 'twitter');
		}
		catch(Exception $e)
		{
			$res['success']=0;
			array_push($res['error'],"twitter-posting-failed");
		}
	}
	
	if($_POST['linkedin']=="on")
	{
		
		//Prep the url for the post request
		$params = array('oauth2_access_token' => $_SESSION['linkedin_token'],
				'format' => 'json',
		);
		$url = 'https://api.linkedin.com/v1/people/~/shares?' . http_build_query($params);
		
		
		$comment=$_POST['text'];
		//Prep the post data
		$data=array(
			"comment" => $comment,
			/*"content" => array(
				"title"=>"Sharing via uPost",
				"description"=>"Leverage the Share API to maximize engagement on user-generated content on LinkedIn",
				"submitted-url"=>"https://developer.linkedin.com/documents/share-api"
			),*/
			"visibility" => array(
				"code"=> "anyone"
			)
		);
		
		//
		//print_r($data);
		
		$c=curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_HTTPHEADER, array(
			"Content-Type: application/json",
			"x-li-format: json"
		));
		
		//Test
		curl_setopt($c, CURLINFO_HEADER_OUT, true);
		
		
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($c, CURLOPT_POST, true);
		curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($data));
		
		
		$result=curl_exec($c);
		
		//print the result from linkedin
		//print_r($result);
		
		//Get the CURL info
		//$info=curl_getinfo($c);
		//print_r($info);
		
		
		array_push($res['ssns'], 'linkedin');
		
		curl_close($c);
	}
	
	
	//Send the response
	if($res['success']==0)
	{
		//Send a problem response
		http_response_code(403);
	}
	
	echo json_encode($res);
	
}
?>