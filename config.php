<?php
	//this file tracks credentials for mysql and for facebook login.

	//Facebook api information
	$host= "upost.websci";
	$appid = "290187461143677";
	$appsecret = "7da03a3fb3b68b3bb8bbb8e593754f40";

	//Get the current host and uri, so that browser redirection works correctly in different development environments
	$fb=array("APPID"=>$appid, "REDIRECT_URI"=>"http://{$host}{$uri}/login.php?sns=facebook", "APP_SECRET"=>$appsecret);
	$tw=array();
	$gp=array();

?>