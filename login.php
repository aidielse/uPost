<?php
require_once("config.php");
require_once("dbconnect.php");

if(!empty($_POST))
{
	if($_POST["sns"]=="login with Facebook")
	{
		$EMAIL="";
		$PASSWORD="";
		$APPID=$fb["APPID"];
		$REDIRECT_URI=$fb["REDIRECT_URI"];
		header("Location: https://www.facebook.com/dialog/oauth?client_id={$APPID}&redirect_uri={$REDIRECT_URI}&response_type=code&scope=publish_actions");
	}
	else 
	{
		echo "No sns is selcted!";
	}
}
else 
{
	if($_GET["sns"]=="facebook")
	{
		$code=$_GET["code"];
		$APPID=$fb["APPID"];
		$REDIRECT_URI=$fb["REDIRECT_URI"];
		$APP_SECRET=$fb["APP_SECRET"];
		
		//Get a short lived token
		$c=curl_init("https://graph.facebook.com/oauth/access_token?client_id={$APPID}&redirect_uri={$REDIRECT_URI}&client_secret={$APP_SECRET}&code={$code}");
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		$ret=curl_exec($c);
		if(!$ret)
		{
			
			login_fail_redirect();
			die();
		}
		//$ret has format access_token=xxxxxxxx&expire=xxxxxx
		parse_str($ret, $q);
		$access_token=$q["access_token"];			
		
		//Exchange the short-lived token for a long-lived access token
		curl_setopt($c, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id={$APPID}&client_secret={$APP_SECRET}&%20fb_exchange_token={$access_token}");
		$ret=curl_exec($c);
		if(!$ret)
		{
			
			login_fail_redirect();
			die();
		}
		parse_str($ret, $q);
		//The Facebook access token
		$access_token=$q["access_token"];
			
		//Get App's access token
		curl_setopt($c, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?client_id={$APPID}&client_secret={$APP_SECRET}&grant_type=client_credentials");
		$ret=curl_exec($c);
		if(!$ret)
		{
			//
			echo "3<br />";
			die();
			login_fail_redirect();
			die();
		}
		parse_str($ret, $q);
		$app_access_token=$q["access_token"];
			
		//Get the user's id
		curl_setopt($c, CURLOPT_URL, "https://graph.facebook.com/debug_token?input_token={$access_token}&access_token={$app_access_token}");
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		$ret=curl_exec($c);
		if(!$ret)
		{
			
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
			
			login_fail_redirect();
			die();
		}
		$username=json_decode($ret, true)["username"];
		
		curl_close($c);
		//Store the access token and username in the database
 		session_start();
 		if(true)//!isset($_SESSION["user"]))
 		{
 			
 			//Check if the user already exists in the facebook table
 			//If not, insert a new user, and insert a new user-to-facebook mapping
 			//If yes, update the access token in the facebook table
 			try
 			{
 				$query="SELECT * FROM facebook WHERE `facebookid`=:userid";
 				$query_params=array("userid"=>$userid);
 				$stmt = $db->prepare($query);
 				$result = $stmt->execute($query_params);
 			
	 			$fb=$stmt->fetch();
	 			if(!$fb)
	 			{
	 				
	 				$query="INSERT INTO users(`userId`) VALUES('')";
	 				$result = $db->exec($query);
	 				$upost_userid=$db->lastInsertId();
	 				
	 				$query="INSERT INTO facebook(`facebookId`, `userId`, `accessToken`) VALUES(:facebookId, :userId, :accessToken)";
	 				$stmt=$db->prepare($query);
	 				$result=$stmt->execute(array("facebookId"=>$userid, "userId"=>$upost_userid, "accessToken"=>$access_token));
	 				
	 			}
	 			else
	 			{
	 				
	 				
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
 			catch(PDOException $ex)
 			{
 				
 				login_fail_redirect();
 				die();	
 			}
 			
 		}
 		else
 		{
			//Redirect to homepage
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'index.php?sns=facebook&login-succeeded=true';
			header("Location: http://$host$uri/$extra");
			die();
 		}
	}
	else 
	{
		echo "POST data is empty!";
		die();
	}
}

function login_fail_redirect()
{
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'about.php?login-succeeded=false';
	header("Location: http://$host$uri/$extra");
}



?>