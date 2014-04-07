<!-- If the user is not logged in, redirect to about.php page, which is the default homepage -->
<?php session_start(); header('Content-Type: text/html; charset=utf-8'); ?>
<?php if(!isset($_SESSION["user"])): ?>
	<?php 
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'about.php';
		header("Location: http://$host$uri/$extra");
	?>
<?php else: ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		
  		<style>
  		
  		</style>
  		
  		<!-- Jquery -->
  		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  		
  		<!-- Bootstrap -->
  		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
  		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
  		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  		
  		<!-- JQueryUI -->
  		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.9.1.js"></script>
  		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  		
  		<!-- stylesheet specific to the site -->
  		<link rel="stylesheet" href="Styles/general.css">
  		
  		<script>
  		$(document).ready(function() {
  	  		//$("#debug").append("Hello bug!").show(200);
  	  		
  	  	});
  		
  		</script>
  		
		<title> uPost Social Network Update Manager</title>
	</head>
	
	<body>
		
		<!-- Navbar(header) -->
		<div class="navbar navbar-default fixed-top" role="navigation">
	        <div class="navbar-header">
	            <a class="navbar-brand" href="index.php">uPOST</a>
	        </div>
	        
	      	<ul class="nav navbar-nav navbar-right">
	        	<li class="dropdown">
	        		<!-- Placeholder for user's username -->
		        	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["user"]["username"]?> <b class="caret"></b></a>
		        	<ul class="dropdown-menu">
		            	<li><a href="#contactus">change username</a></li>
		       	    	<li><a href="#github">change password</a></li>
		       	    </ul>
          		</li>
          		
          		<li class="dropdown">
          			<!-- User's current social accounts  -->
          			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Accounts <b class="caret"></b></a>
          			<ul class="dropdown-menu">
          				<!-- Placeholder for social accounts -->
         				<li><li>
          				<li><li>
          				<li><li>
          			</ul>
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
			    	<script>
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
<?php endif;?>
