<?php
	//this file tracks credentials for google+
	require_once './google-api-php-client/src/Google_Client.php';
	require_once './google-api-php-client/src/contrib/Google_PlusService.php';

	//this file for Twitter
	require_once './twitter-api-php-client/twitteroauth/twitteroauth.php';

	$host = "uPost.websci";
	//Make it GLOBAL
	define('HOST',"uPost.websci");
	$uri="";
	//Facebook api information
	$appid = "722200331145073";
	$appsecret = "5b98d8acacdd0c144ab71197a344a87b";
	$fb=array("APPID"=>$appid, "REDIRECT_URI"=>"http://{$host}{$uri}/login.php?sns=facebook", "APP_SECRET"=>$appsecret);
	
	//Twitter api credentials
	$consumer_key="yVqGgDv0G6KLLMRpgvKL5Fdft";
	$consumer_secret="KtzAMX2LuTvabvFaUu8MeCgYIEyRnrS7qtLLlExtzNIRl9AqVg";
	$auth_callback="http://{$host}{$uri}/login.php?sns=twitter";
	
	
	//Google+ api credentials
	$googleplus_developer_key="AIzaSyC6ggim_1iP8T_8Qz8DWjRo5peZabQkEnw";
	$client = new Google_Client();
	$client->setApplicationName("Google+ PHP uPost app");
	$client->setClientId('983819609735-ueud5lh1r2e04f3klssqrqehqfagt9ls.apps.googleusercontent.com');
	$client->setClientSecret('F3esmITnFr44WJNB91FyQTy_');
	$client->setRedirectUri('http://localhost/uPost/login.php?sns=googleplus');
	$client->setDeveloperKey('AIzaSyC6ggim_1iP8T_8Qz8DWjRo5peZabQkEnw');
	$plus = new Google_PlusService($client);
	//Get the current host and uri, so that browser redirection works correctly in different development environments

?>