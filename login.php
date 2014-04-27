<?php
	require_once("config.php");
	//linkedin state
	$state = "DCFEFWF45453sdffef424";
	if(!empty($_POST)) {
		//if the user it attempting to log in with facebook

		if($_POST["sns"]=="login with LinkedIn") {
			header("Location: https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id={$api_key}&state={$state}&scope=rw_nus&redirect_uri={$linkedin_redirect}");
		}
		else if($_POST["sns"]=="login with Facebook") {
			//grab information from config.php
			//echo "hello";
			$APPID=$fb["APPID"];
			$REDIRECT_URI=$fb["REDIRECT_URI"];
			//redirect the user to facebook to login, we also pass our credentials to facebook
			header("Location: https://www.facebook.com/dialog/oauth?client_id={$APPID}&redirect_uri={$REDIRECT_URI}&response_type=code&scope=publish_actions,read_stream");
		}
		else if($_POST["sns"]=="login with Twitter"){
			/* Build TwitterOAuth object with client credentials. */
			$connection = new TwitterOAuth($consumer_key, $consumer_secret);
			/* Get temporary credentials. */
			$request_token = $connection->getRequestToken($auth_callback);
			
			//print request token
			//echo "request_token: ";
			//print_r($request_token);
			
			/* Get authorize url to redirect user to twitter login page*/
			$url = $connection->getAuthorizeURL($request_token['oauth_token']);
			//Save a temporary session variable for later use in the login flow
			session_start();
			session_name('upost');
			$_SESSION["tw_login"]=array('OAuth_token' => $request_token['oauth_token'], 'OAuth_token_secret' => $request_token['oauth_token_secret'], "OAuthorize_URL"=>$url);
			
			//print SESSION var tw_login
			//echo "session var tw_login: ";
			//print_r($_SESSION["tw_login"]);
			
			header("Location: ".$url);
			die();
		}
		else {
			echo "No sns is selected!";
		}
		
	}
	
	else {

		session_set_cookie_params(604800);
		session_start(); 
		session_name('upost');
		
		//print SESSION 
		//echo "session: ";
		//print_r($_SESSION);
		
		
		//once the user is verified with facebook and we have an app code
		if($_GET["sns"]=="facebook") {
			//echo "facebook login complete\n";
			//get variables from config.php and the get request
			$code=$_GET["code"];
			$APPID=$fb["APPID"];
			$REDIRECT_URI=$fb["REDIRECT_URI"];
			$APP_SECRET=$fb["APP_SECRET"];
			
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
				login_fail_redirect("failed-getting-short-term-token-facebook");
				
				die();
			}
			
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
				login_fail_redirect("failed-getting-long-term-token-facebook");
				die();
			}
			//get the actual long-term access token from $ret
			parse_str($ret, $q);
			//The Facebook access token
			$access_token=$q["access_token"];
			//store the long term access token in the session
			$_SESSION['fb_access_token'] = $access_token;
			//echo $_SESSION['fb_access_token'];
			//exit curl
			curl_close($c);
			
			login_succeed_redirect("facebook");
	 				 		
		}
		//once the user is verified with twitter
		else if($_GET["sns"]=="twitter"){
			/* If the oauth_token is old redirect to the home page. */
			if (isset($_REQUEST['oauth_token']) && $_SESSION['tw_login']['OAuth_token'] !== $_REQUEST['oauth_token']) {
				session_destroy();
				login_fail_redirect("login-timed-out-twitter");	
				die();
			}
			if(isset($_REQUEST['denied']))
			{
				session_destroy();
				login_fail_redirect("user-denied-twitter");
				die();
			}
			/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
			$connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['tw_login']['OAuth_token'], $_SESSION['tw_login']['OAuth_token_secret']);
			
			/* Request access tokens from twitter */
			//user has the structure: Array ([oauth_token] => xxx [oauth_token_secret] => xxx [user_id] => 123 [screen_name] => xxx)
			$user = $connection->getAccessToken($_REQUEST['oauth_verifier']);
			
			$access_token = $user['oauth_token'];
			$access_token_secret=$user['oauth_token_secret'];
			$userid=$user['user_id'];
			$username=$user['screen_name'];
			
			/* Save the access tokens. */
			$_SESSION['tw_access_token'] = $access_token;
			$_SESSION['tw_access_token_secret']=$access_token_secret;
			
			/* Remove no longer needed request tokens */
			unset($_SESSION['tw_login']);
			
			login_succeed_redirect("twitter");
		}
		else if($_GET["sns"]=="linkedin") {

			if($_GET['state'] == $state) {

				$linkedin_code = $_GET["code"];

				$url = "https://www.linkedin.com/uas/oauth2/accessToken?grant_type=authorization_code&code={$linkedin_code}&redirect_uri={$linkedin_redirect}&client_id={$api_key}&client_secret={$api_secret}";
	        	$c=curl_init($url);
				//echo "curl initialized\n";
				//configure curl options so that curl_exec($c) returns the short term token as a string.
				curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
				//echo "about to run curl_exec\n";
				//$ret holds the short term access token
				$ret=curl_exec($c);
				curl_close($c);

				//print_r($ret);
				
				$obj = json_decode($ret);
				$access_token = $obj->{'access_token'};

				$_SESSION['linkedin_token'] = $access_token;
				login_succeed_redirect("linkedin");
	        }

		}
	}
	
	function login_succeed_redirect($ssn="unknown") {
		//Redirect to about.php
		session_write_close();
		$host=HOST;
		$extra = "about.php?login={$ssn}";
		header("Location: http://$host/$extra");
	}
	function login_fail_redirect($error="unknown") {
		//redirect to about.php with optional error msg
		session_write_close();
		$host=HOST;
		$extra = "index.php?error={$error}";
		header("Location: http://$host/$extra");
	}
?>