<?php
	//this file tracks credentials for google+
	require_once './google-api-php-client/src/Google_Client.php';
	require_once './google-api-php-client/src/contrib/Google_PlusService.php';

	//this file for Twitter
	require_once './twitter-api-php-client/twitteroauth/twitteroauth.php';

	//this file for Facebook
	require_once 'facebook-php-sdk/src/facebook.php';

	$host = "upost.heroku.com";
	//Make it GLOBAL
	define('HOST',"upost.heroku.com");
	$uri="";
	//Facebook api information
	$appid = "290187461143677";
	$appsecret = "7da03a3fb3b68b3bb8bbb8e593754f40";
	$fb=array("APPID"=>$appid, "REDIRECT_URI"=>"http://{$host}{$uri}/login.php?sns=facebook", "APP_SECRET"=>$appsecret);

	//Twitter api credentials
	$consumer_key="yVqGgDv0G6KLLMRpgvKL5Fdft";
	$consumer_secret="KtzAMX2LuTvabvFaUu8MeCgYIEyRnrS7qtLLlExtzNIRl9AqVg";
	$auth_callback="http://{$host}{$uri}/login.php?sns=twitter";


	//Google+ api credentials
	$googleplus_developer_key="AIzaSyC6ggim_1iP8T_8Qz8DWjRo5peZabQkEnw";
	$client = new Google_Client();
	$client->setApplicationName("Google+ PHP uPost app");
	$client->setClientId('983819609735-4a2pfaagttqonbc69t82u9p2bhqgnch7.apps.googleusercontent.com');
	$client->setClientSecret('DnzO7MU5ef9Ka3s-b-nhR6gU');
	$client->setRedirectUri('https://upost.heroku.com/login.php?sns=googleplus');
	$client->setDeveloperKey('AIzaSyC6ggim_1iP8T_8Qz8DWjRo5peZabQkEnw');
	$plus = new Google_PlusService($client);
	//Get the current host and uri, so that browser redirection works correctly in different development environments

?>
