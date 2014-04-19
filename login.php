<?php
	require_once("config.php");
	//require_once("dbconnect.php");
	//for successful login
	$sns='';

	if(!empty($_POST)) {
		//if the user it attempting to log in with facebook
		if($_POST["sns"]=="login with Facebook") {
			//grab information from config.php
			//echo "hello";
			$APPID=$fb["APPID"];
			$REDIRECT_URI=$fb["REDIRECT_URI"];
			//redirect the user to facebook to login, we also pass our credentials to facebook
			header("Location: https://www.facebook.com/dialog/oauth?client_id={$APPID}&redirect_uri={$REDIRECT_URI}&response_type=code&scope=publish_actions");
		}
		else {
			echo "No sns is selected!";
		}
	}
	
	else {

		session_set_cookie_params(604800);
		session_start(); 
		session_name('upost');
		//once the user is verified with facebook and we have an app code
		if($_GET["sns"]=="facebook") {
			//echo "facebook login complete\n";
			//get variables from config.php and the get request
			$code=$_GET["code"];
			$APPID=$fb["APPID"];
			$REDIRECT_URI=$fb["REDIRECT_URI"];
			$APP_SECRET=$fb["APP_SECRET"];

			//echo "wut\n";
			//Get a short lived token
			//phpinfo();
			$c=curl_init("https://graph.facebook.com/oauth/access_token?client_id={$APPID}&redirect_uri={$REDIRECT_URI}&client_secret={$APP_SECRET}&code={$code}");
			//echo "curl initialized\n";
			//configure curl options so that curl_exec($c) returns the short term token as a string.
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
			//echo "about to run curl_exec\n";
			//$ret holds the short term access token
			$ret=curl_exec($c);
			//if we couldn't get the short term token
			if(!$ret)
			{
				//echo "failed getting short-term access token\n";
				login_fail_redirect();
				die();
			}
			//echo "something happened";

			//$ret has format access_token=xxxxxxxx&expire=xxxxxx
			parse_str($ret, $q);
			//parse the short term access token to seperate the expiration,
			//store the short term access token in $access_token
			$access_token=$q["access_token"];			
			//Exchange the short-lived token for a long-lived access token
			//change the curl url to include the short-term access token
			curl_setopt($c, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id={$APPID}&client_secret={$APP_SECRET}&%20fb_exchange_token={$access_token}");
			//execute the curl, store the long term access token in $ret
			$ret=curl_exec($c);

			//if $ret is null, curl_exec() didn't work
			if(!$ret)
			{
				//echo "Failed getting long-term access token\n";
				login_fail_redirect();
				die();
			}
			//get the actual long-term access token from $ret
			parse_str($ret, $q);
			//The Facebook access token
			$access_token=$q["access_token"];
			//store the long term access token in the session
			$_SESSION['login'] = 'facebook';
			$_SESSION['fb_access_token'] = $access_token;
			//echo $_SESSION['fb_access_token'];
			//exit curl
			curl_close($c);
			//Store the access token and username in the database	 
			login_succeed_redirect();
	 				 		
		}
		else {
			echo "POST data is empty!";
			die();
		}
	}
	function login_succeed_redirect() {
			//Redirect to homepage
			session_write_close();
			$sns = 'facebook';
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'about.php';
			header("Location: http://$host$uri/$extra");
	}
	function login_fail_redirect() {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
	}
?>