<?php
	require_once("config.php");
	require_once("dbconnect.php");

	if(!empty($_POST)) {
		//if the user it attempting to log in with facebook
		if($_POST["sns"]=="login with Facebook") {
			//grab information from config.php
			$APPID=$fb["APPID"];
			$REDIRECT_URI=$fb["REDIRECT_URI"];
			//redirect the user to facebook to login, we also pass our credentials to facebook
			header("Location: https://www.facebook.com/dialog/oauth?client_id={$APPID}&redirect_uri={$REDIRECT_URI}&response_type=code&scope=publish_actions");
		}
		else {
			echo "No sns is selected!";
		}
	}
	//
	else {
		//once the user is verified with facebook and we have an app code
		if($_GET["sns"]=="facebook") {
			//get variables from config.php and the get request
			$code=$_GET["code"];
			$APPID=$fb["APPID"];
			$REDIRECT_URI=$fb["REDIRECT_URI"];
			$APP_SECRET=$fb["APP_SECRET"];

			//echo "wut";
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
				
			//Get App's access token
			//change curl url setting so that we can get the app access token
			curl_setopt($c, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?client_id={$APPID}&client_secret={$APP_SECRET}&grant_type=client_credentials");
			//execute, store app access token in $ret
			$ret=curl_exec($c);
			if(!$ret)
			{
				//echo "failed getting app access token";
				//die();
				login_fail_redirect();
				die();
			}

			parse_str($ret, $q);
			//save app access token into $app_access_token
			$app_access_token=$q["access_token"];
				
			//Get the user's id
			curl_setopt($c, CURLOPT_URL, "https://graph.facebook.com/debug_token?input_token={$access_token}&access_token={$app_access_token}");
			curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
			//user id gets saved in $ret
			$ret=curl_exec($c);
			if(!$ret)
			{
				//echo "failed to get facebook user_id\n";
				login_fail_redirect();
				die();
			}
			//Get user_id from the decoded json object, and format it to a non-scientific string number
			$userid=(json_decode($ret, true)["data"]["user_id"]);
			$userid=(sprintf('%.0f', $userid));
			
			//Get the user's username
			curl_setopt($c, CURLOPT_URL, "https://graph.facebook.com/{$userid}?fields=id,name,username&access_token={$access_token}");
			curl_setopt($c, CURLOPT_POSTFIELDS, array("access_token"=>$access_token));
			curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");
			$ret=curl_exec($c);
			if(!$ret)
			{
			//	echo "Failed to get username\n";
				login_fail_redirect();
				die();
			}
			//Get username from the decoded json object
			$username=json_decode($ret, true)["username"];
			//exit curl
			curl_close($c);
			//Store the access token and username in the database
	 		//session_start();
	 		if(true){
	 			
	 			//Check if the user already exists in the facebook table
	 			//If not, insert a new user, and insert a new user-to-facebook mapping
	 			//If yes, update the access token in the facebook table
	 			try {

	 				$query="SELECT * FROM facebook WHERE `facebookid`=:userid";
	 				$query_params=array("userid"=>$userid);
	 				$stmt = $db->prepare($query);
	 				$result = $stmt->execute($query_params);
	 			
		 			$fb=$stmt->fetch();
		 			if(!$fb) {
		 				
		 				$query="INSERT INTO users(`userId`) VALUES('')";
		 				$result = $db->exec($query);
		 				$upost_userid=$db->lastInsertId();
		 				
		 				$query="INSERT INTO facebook(`facebookId`, `userId`, `accessToken`) VALUES(:facebookId, :userId, :accessToken)";
		 				$stmt=$db->prepare($query);
		 				$result=$stmt->execute(array("facebookId"=>$userid, "userId"=>$upost_userid, "accessToken"=>$access_token));
		 				
		 			}
		 			else {
		 					
		 				$query="UPDATE `facebook` SET `accessToken`=:accessToken WHERE `facebookId`=:facebookId";
		 				$stmt=$db->prepare($query);
		 				$result=$stmt->execute(array("accessToken"=>$access_token, "facebookId"=>$userid));
		 				
		 			}
		 			$_SESSION["user"]=array("username"=>$username, "userid"=>$userid);	
		 			
		 			//Redirect to homepage
		 			$host  = $_SERVER['HTTP_HOST'];
		 			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		 			$extra = 'index.php?sns=facebook&login-succeeded=true';
		 			header("Location: http://$host$uri/$extra");
		 			die();
	 			}
	 			catch(PDOException $ex) {
	 				echo "PDO failure\n";
	 				login_fail_redirect();
	 				die();	
	 			}
	 			
	 		}
	 		else {
				//Redirect to homepage
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'index.php?sns=facebook&login-succeeded=true';
				header("Location: http://$host$uri/$extra");
				die();
	 		}
		}
		else {
			echo "POST data is empty!";
			die();
		}
	}

	function login_fail_redirect() {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'about.php?login-succeeded=false';
		//header("Location: http://$host$uri/$extra");
	}
?>