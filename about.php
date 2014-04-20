<?php
//checks to make sure that the user has been logged in and has an access token
//if the user has no access token, they are redirected to index.php
session_start();

	//echo $_SESSION['g+_is_logged_in'];

	if(isset($_SESSION['fb_access_token'])) {}

	else if($_SESSION['g+_is_logged_in'] == "ye") {}
	
	else {header("Location: http://localhost/uPost/");}

	if($_GET['action'] == 'logout') {
		session_destroy();
		header("Location: http://localhost/uPost/");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		  		
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
  		
  		<!-- stylesheet specific to the site -->
  		<link rel="stylesheet" type="text/css" href="Styles/general.css">
  		
  		<script type = "text/javascript">
	  		$(document).ready(function() {
	  	  		//$("#debug").append("Hello bug!").show(200);
	  	  	});
  		</script>
  		
		<title>uPost Social Network Update Manager</title>
	</head>
	
	<body>
		
		<!-- Navbar(header) -->
		<div class="navbar navbar-default fixed-top" role="navigation">
	        <div class="navbar-header">
	            <a class="navbar-brand" href="index.php">uPOST</a>
	        </div>
	        
	      	<ul class="nav navbar-nav navbar-right">
          		
          		<li class="item" onclick="window.location='about.php?action=logout'"><a href="#" data-toggle="modal" data-target="#user_login">
          			Log Out
          		</li>
		    </ul>
		</div>
		
		<!-- For client-side notifications -->
		<?php require_once("alert.php");?>
		
		<!-- Main body. Post area -->
		<div class="fluid-container">
			<div class="row">
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			    <div class="col-md-8 panel custom-panel">
			    	<!-- Get the user's current location -->
			    	<script type="text/javascript">
			    	function saveLocation(position)
			    	{
				    	$("#current_loc").html(position.coords.latitude+" "+position.coords.longitude);
			    	}
			    	function showError(error)
			    	{
			    		switch(error.code) 
					    {
					    case error.PERMISSION_DENIED:
					      $("#current_loc").html("User denied the request for Geolocation.");
					      break;
					    case error.POSITION_UNAVAILABLE:
						  $("#current_loc").html("Location information is unavailable.");
					      break;
					    case error.TIMEOUT:
						  $("#current_loc").html("The request to get user location timed out.");
					      break;
					    case error.UNKNOWN_ERROR:
						  $("#current_loc").html("An unknown error occurred.");
					      break;
					    }
			    	}
			    	if(navigator.geolocation)
			    	{
			    		navigator.geolocation.getCurrentPosition(saveLocation, showError);
			    	}
					</script>
					
					<!-- User's post -->
				    <form role="form">
				    
				    	<!-- Text area -->
			    		<div class="form-group">
			    			<label for="post_text">Write something and public everywhere!</label>
			    			<textarea id="post_text" class="form-control" placeholder="Write something you want to say..." rows="5"></textarea>
			    			
			    		</div>
			    		
			    		<!-- Current Location -->
			    		<div class="form-group">
			    		    <div class="row">
			    			    <div class="col-sm-3">
			    				    <label>Your current location:</label>
			    			    </div>
			    				<div class="col-sm-3">
			    				<p id="current_loc"></p>
			    				</div>
			    			</div>
			    		</div>
			    		
			    		<!-- SNS options -->
			    		<div class="form-group">
			    			<!-- Generated dynamically -->
			    			
			    			<img src="Images/Logos/facebook.jpg" height="20">
			    			<label class="checkbox-inline">
			    				<input type="checkbox">
			    			</label>
			    			<span>&nbsp;&nbsp;</span>
			    			
			    			<img src="Images/Logos/twitter.jpg" height="20">
			    			<label class="checkbox-inline">
			    			<input type="checkbox">
			    			</label>
			    			<span>&nbsp;&nbsp;</span>
			    		</div>
			    		
			    		<div class="form-group">
			    			<input class="btn btn-default btn-block" type="submit" value="uPOST!">
			    		</div>
			    		
			    	</form>
			    </div>
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
		</div>
	</body>
</html>