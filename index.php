<?php
	require_once 'config.php';
	//checks to see if the user has a session.
	//if the user has a session, they are redirected to the user page
	session_start();
	if(isset($_SESSION['fb_access_token'])) {

		header("Location: http://{$host}/about.php");
		die("Redirecting to "."http://{$host}/about.php");
	}
	else if(isset($_SESSION['tw_access_token'])){
		header("Location: http://{$host}/about.php");
	}
	
?>

<html>
	<body>
		<head>
			<meta charset="utf-8">
	  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  		<meta name="viewport" content="width=device-width, initial-scale=1">
	  		<title>uPost Social Network Update Manager</title>
	  		
	  		<!-- Jquery -->
	  		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	  		
	  		<!-- Bootstrap -->
	  		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	  		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
	  		<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	  		
	  		<!-- JQueryUI -->
	  		<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	  		<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
	  		<script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	  		
	  		<link rel="stylesheet" type="text/css" href="Styles/general.css">
  		</head>
  		
		<!-- Popup for user login -->
		<!-- Form data format: [username]->xxx, [password]->xxx, [sns]->login with xxx -->
		<div class="modal fade" id="user_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Login</h4>
		      </div>
		      <div class="panel panel-default">
		        <div class="panel-body">
			      <form role="form" action="login.php" method="post" autocomplete="on">
			          <div class="form-group">
			            <input id="fb_login" name="sns" class="btn btn-primary btn-block btn-lg" type="submit" value="login with Facebook">
			          	<input id="tw_login" name="sns" class="btn btn-primary btn-block btn-lg" type="submit" value="login with Twitter">
			          	<input id="tw_login" name="sns" class="btn btn-primary btn-block btn-lg" type="submit" value="login with LinkedIn">
			          </div>
			      </form>
			    </div>
		      </div>
		    </div>
		  </div>
		</div>
		
		<!-- Nav header -->
		<nav class="navbar navbar-default fixed-top" role="navigation">
		  <div class="container-fluid">
	        <div class="navbar-header">
	            <a class="navbar-brand" href="index.php">uPost</a>      	
		    </div>
		        
		    <ul class="nav navbar-nav navbar-right">
	        	<li><a href="#" data-toggle="modal" data-target="#user_login">Login</a></li>
		       	<li><a href="#contactus">Contact Us</a></li>
	        </ul>	
	      </div>        
        </nav>
		<!-- For client-side notifications -->
		<?php include("alert.php");?>
		<div class="fluid-container">
			<div class="row">
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			    <div class="col-md-8 panel custom-panel">
			    	<h1>What is uPost?</h1>
			    	<p>Focus on what and where to post. uPost takes care of the rest.</p>
					<p>uPost is a web application via which users can post content to multiple social media.</p>
					<p>We hope uPost can inspire creation instead of plain sharing.</p>
			    </div>
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
			<div class="row" id="contactus">
				<div class="col-md-2 hidden-sm hidden-xs"></div>
			    <div class="col-md-8 panel custom-panel">
			    	<h1>Contact Us: </h1>
			    	<p>Aaron Sedlacek: <a href="mailto:aarons104@gmail.com">aarons104@gmail.com</a></p>
			    	<p>Evan MacGregor: <a href="mailto:macgregor.evan@gmail.com">macgregor.evan@gmail.com</a></p>
			    	<p>Yufan Lou: <a href="mailto:louy2@rpi.edu">louy2@rpi.edu</a></p>
			    	<p>Mike Xie: <a href="mailto:xiey3@rpi.edu">xiey3@rpi.edu</a></p>
			    	<p>Mohd Farhan Jalal: <a href="jalalm@rpi.edu">jalalm@rpi.edu</a></p>
			    </div>
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
		</div>
	</body>
</html>
