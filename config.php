<?php
	//this file tracks credentials for mysql and for facebook login.

	//Store mysql information
	//phpuser1 is the username that is created by db-init.sql for this app.
	$username = "phpuser1";
	$password = "phppass";
	$host = "uPost.websci";
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	//Facebook api information
	$appid = "290187461143677";
	$appsecret = "7da03a3fb3b68b3bb8bbb8e593754f40";

	$database=array("username" => $username, "password"=>$password, "host"=>$host, "dbname"=>"uPost");

	//Get the current host and uri, so that browser redirection works correctly in different development environments

	$fb=array("APPID"=>$appid, "REDIRECT_URI"=>"http://{$host}{$uri}/login.php?sns=facebook", "APP_SECRET"=>$appsecret);
	$tw=array();
	$gp=array();

?>