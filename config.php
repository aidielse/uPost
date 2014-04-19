<?php
	//this file tracks credentials.
	require_once './google-api-php-client/src/Google_Client.php';
	require_once './google-api-php-client/src/contrib/Google_PlusService.php';

	$host= "localhost";
	//Facebook api information
	$appid = "290187461143677";
	$appsecret = "7da03a3fb3b68b3bb8bbb8e593754f40";
	$fb=array("APPID"=>$appid, "REDIRECT_URI"=>"http://{$host}{$uri}/login.php?sns=facebook", "APP_SECRET"=>$appsecret);

	//Google+ api stuff
	$client = new Google_Client();
	$client->setApplicationName("Google+ PHP uPost app");
	$client->setClientId('983819609735-ss1oums2a77a93iv2hi2ailqb6974mut.apps.googleusercontent.com');
	$client->setClientSecret('-XUe29OePy_S-KpuZhybmQdw');
	$client->setRedirectUri('http://upost.websci/login.php?sns=googleplus');
	$client->setDeveloperKey('AIzaSyC6ggim_1iP8T_8Qz8DWjRo5peZabQkEnw');
	$plus = new Google_PlusService($client);
	//Get the current host and uri, so that browser redirection works correctly in different development environments
	$tw=array();
?>