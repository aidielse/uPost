<?php

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
	$auth_callback="http://{$host}/login.php?sns=twitter";

	//LinkedIn api credentials
	$api_key = "77ztd75hs9c4x5";
	$api_secret = "M8zfmZMykL85DfQn";
	$oauth_user_token = "6f062011-2ccc-415d-ade5-8952987c55f6";
	$oauth_user_secret = "ecc073e3-4785-42fe-abac-bf1972b83088";
	$linkedin_redirect = "http://{$host}/login.php?sns=linkedin";
?>
