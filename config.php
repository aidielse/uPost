<?php
	//this file tracks credentials for google+
	require_once './google-api-php-client/src/Google_Client.php';
	require_once './google-api-php-client/src/contrib/Google_PlusService.php';

	//this file for Twitter
	require_once './twitter-api-php-client/twitteroauth/twitteroauth.php';
	
	//this file for Facebook
	require_once 'facebook-php-sdk/src/facebook.php';

	$host = "localhost/uPost";
	//Make it GLOBAL
	define('HOST',"localhost/uPost");
	
	//Facebook api information
	$appid = "290187461143677";
	$appsecret = "7da03a3fb3b68b3bb8bbb8e593754f40";
	$fb=array("APPID"=>$appid, "REDIRECT_URI"=>"http://{$host}/login.php?sns=facebook", "APP_SECRET"=>$appsecret);
	
	//Twitter api credentials
	$consumer_key="yVqGgDv0G6KLLMRpgvKL5Fdft";
	$consumer_secret="KtzAMX2LuTvabvFaUu8MeCgYIEyRnrS7qtLLlExtzNIRl9AqVg";
	$auth_callback="http://{$host}/login.php?sns=twitter";
	


?>