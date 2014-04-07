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
  		
  		<link rel="stylesheet" href="Styles/general.css">
  		
  		<script>
  		$(document).ready(function() {
  	  		//$("#debug").append("Hello bug!").show(200);
  	  		
  	  	});
  		
  		</script>
  		
		<title> uPost Social Network Update Manager</title>
	</head>
<?php $_SESSION["user"]="Anonymous"; ?>
<?php if(!isset($_SESSION["user"])): ?>
	<body>
		<!-- Popup for user login -->
		<div class="modal fade" id="user_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Login</h4>
		      </div>
		      <form role="form">
		      
		        <div class="modal-body">
		          <div class="form-group">
		            <label>Username:</label>
		            <input id="login_name" class="form-control" type="text">
		          </div>
		          <div class="form-group">
		            <label>Password:</label>
		            <input id="login_password" class="form-control" type="password">
		          </div>
		        </div>
		        <div class="modal-footer">
		          <div class="form-group">
		            <input class="btn btn-primary btn-block" type="submit" value="Log in" >
		          </div>
		        </div>
		      </form>
		    </div>
		  </div>
		</div>
		
		<!-- Popup for user register -->
		<div class="modal fade" id="user_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Login</h4>
		      </div>
		      <form role="form">
		      
		        <div class="modal-body">
		          <div class="form-group">
		            <label>Username:</label>
		            <input id="register_name" class="form-control" type="text">
		          </div>
		          <div class="form-group">
		            <label>Password:</label>
		            <input id="register_password" class="form-control" type="password">
		          </div>
		          <div class="form-group">
		            <label>Password again:</label>
		            <input id="register_password_again" class="form-control" type="password">
		          </div>
		        </div>
		        <div class="modal-footer">
		          <div class="form-group">
		            <input class="btn btn-primary btn-block" type="submit" value="Register" >
		          </div>
		        </div>
		      </form>
		    </div>
		  </div>
		</div>
		
		<!-- Nav header -->
		<div class="fluid-container">
		    <div class="navbar navbar-default fixed-top" role="navigation">
		        <div class="navbar-header">
		            <a class="navbar-brand" href="index.php">uPOST</a>
		          	
		        </div>
		        
		        <ul class="nav navbar-nav navbar-right">
		        	<li><a href="#" data-toggle="modal" data-target="#user_login">Login</a></li>
		        	<li><a href="#" data-toggle="modal" data-target="#user_register">Register</a></li>
		        	<li class="dropdown">
		        		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Know about us <b class="caret"></b></a>
		        	    <ul class="dropdown-menu">
		        	    	<li><a href="#contactus">Contact Us</a></li>
		        	    	<li><a href="#github">Follow on Github</a></li>
		        	    </ul>
		        	
		        	
          			</li>
		        </ul>
		        
		    </div>
		</div>
		<?php require_once("alert.php");?>
		<div class="fluid-container">
			<div class="row">
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			    <div class="col-md-8 panel custom-panel">
			    	<h1>What is uPOST?</h1>
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
			<div class="row" id="contactus">
				<div class="col-md-2 hidden-sm hidden-xs" id="github"></div>
			    <div class="col-md-8 panel custom-panel">
			    	<h1>Follow Us on Github: </h1>
			    	<p>Github Repo: <a href="https://github.com/Aarons100/uPost">https://github.com/Aarons100/uPost</a></p>
			    	<br />
			    	<br />
			    	<br />
			    </div>
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
		</div>
	</body>
<?php else: ?>
	<body>
		<div class="fluid_container">
			<div class="navbar navbar-default fixed-top" role="navigation">
		        <div class="navbar-header">
		            <a class="navbar-brand" href="index.php">uPOST</a>
		          	
		        </div>
		        
		        <ul class="nav navbar-nav navbar-right">
		        	<li class="dropdown">
		        		<!-- Generated dynamically -->
		        		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Username <b class="caret"></b></a>
		        	    <ul class="dropdown-menu">
		        	    	<li><a href="#contactus">change username</a></li>
		        	    	<li><a href="#github">change password</a></li>
		        	    </ul>
          			</li>
          			<li class="dropdown">
          				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Accounts <b class="caret"></b></a>
          				<ul class="dropdown-menu">
          					<!-- Generated dynamically -->
          					<li><li>
          					<li><li>
          					<li><li>
          				</ul>
          			</li>
		        </ul>
		    </div>
		</div>
		<?php require_once("alert.php");?>
		<div class="fluid-container">
			<div class="row">
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			    <div class="col-md-8 panel custom-panel">
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
				    <form role="form">
			    		<div class="form-group">
			    			<label for="post_text">Write something and public everywhere!</label>
			    			<textarea id="post_text" class="form-control" placeholder="Write something you want to say..." rows="5"></textarea>
			    			
			    		</div>
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
<?php endif;?>
</html>