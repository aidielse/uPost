uPost
=====

Focus on what and where to post. uPost takes care of the rest.

uPost is a web application via which users can post content to multiple social media.

We hope uPost can inspire creation instead of plain sharing.

Installation Instructions
=========================

1. ensure that both mysql and apache are installed. uPost requires a working mysql database.

2. run mysql, pipe in the db-init.sql file located in /RESOURCES/Database/db-init.sql.

	mysql < db-init.sql

3. Configure apache2 to serve our website, set the DocumentRoot to the current folder.

4. create a config.php file which contains the following:

	<?php

	//Store mysql information
	$username = "phpuser1";
	$password = "phppass";
	$host = "localhost";
	//store facebook api information
	$appid = "";
	$appsecret = "";

	$database=array("username" => $username, "password"=>$password, "host"=>$host, "dbname"=>"uPost");

	//Get the current host and uri, so that browser redirection works correctly in different development environments

	$fb=array("APPID"=>$appid, "REDIRECT_URI"=>"./login.php?sns=facebook", "APP_SECRET"=>$appsecret);
	$tw=array();
	$gp=array();

	?>

5. Make sure you enter your own custom values for $username, $password, $host(if necessary), $appid, and $appsecret