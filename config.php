<?php 
//Store app-realted information
$database=array("username"=>"root", "password"=>"dddd", "host"=>"localhost", "dbname"=>"unknown");

//Get the current host and uri, so that browser redirection works correctly in different development environments
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$fb=array("APPID"=>"722200331145073", "REDIRECT_URI"=>"http://{$host}{$uri}/login.php?sns=facebook", "APP_SECRET"=>"5b98d8acacdd0c144ab71197a344a87b");
$tw=array();
$gp=array();

?>