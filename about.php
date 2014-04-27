<?php
require_once 'config.php';

session_start();


	//checks to make sure that the user has been logged in and has an access token
	//if the user has no access token, they are redirected to index.php
	if(isset($_SESSION['fb_access_token'])) {}

	else if(isset($_SESSION['g+_is_logged_in'])) {}
	
	else if(isset($_SESSION['tw_access_token'])){
		
	}
	
	else {header("Location: http://localhost/uPost/");}
	//if the user presses the logout button, they are logged out
	if(isset($_GET['action']) && $_GET['action'] == 'logout') {
		session_destroy();
		header("Location: http://{$host}/index.php");
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
  		
  		<!-- Google Map API -->
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleplus_developer_key?>&sensor=true"></script>
  		
  		<!-- stylesheet specific to the site -->
  		<link rel="stylesheet" type="text/css" href="Styles/general.css">
  		
  		<script type = "text/javascript">
	  		$(document).ready(function() {
				//Character counter
				var text=$("#post_text").val();
				$("#char_count").html(text.length);
				$("#post_text").on("keyup", function(){
					var text=$(this).val();
					$("#char_count").html(text.length);
				});
				
		  		
	  	  		$("#submit").on('click', function(e){
		  	  		e.preventDefault();
					//Prepare the data to be sent
					var text=$("form [name='text']").val();
					var loc=$("#current_loc").html().split(" ");
					var lat=loc[0];
					var lon=loc[1];
					var location=false;
					var facebook="off";
					var twitter="off";
					var google_plus="off";
					
		  	  		if($("form [name='location']").prop('checked')==true)
		  	  		{
			  	  		location=true;
		  	  		}

		  	  		var all_off=true;
		  	  		if($("form [name='facebook']").prop('checked')==true)
		  	  		{
			  	  		facebook="on";
			  	  		all_off=false;
		  	  		}
		  	  		if($("form [name='twitter']").prop('checked')==true)
		  	  		{
			  	  		twitter="on";
			  	  		//Check for characters count
			  	  		if(parseInt($("#char_count").html())>144)
			  	  		{
				  	  		window.location="about.php?error=char-count-excceeds";
			  	  		}
			  	  		all_off=false;
			  	  	}
		  	  		if($("form [name='googleplus']").prop('checked')==true)
		  	  		{
			  	  		google_plus="on";
			  	  		all_off=false;
		  	  		}
		  	  		//If the user didn't select any sns, stop and inform the user
		  	  		if(all_off)
		  	  		{
		  	  			window.location="about.php?error=all-off";
		  	  		}

		  	  		var data={
				  	  	text: text, 
				  	  	lat: lat,
				  	  	long: lon,
				  	  	location: location,
				  	  	facebook: facebook,
				  	  	twitter: twitter,
				  	  	"googleplus":google_plus
				  	};
		  	  		
		  	  		$.ajax({
			  	  		url:"post.php",
			  	  		type:"POST",
			  	  		ajax: true,
			  	  		data:data,
			  	  		dataType: "json",
			  	  		success:function(data, textStatus, jqXHR){
				  	  		//console.dir(data);
				  	  		$("#sites_posted_to").html("");
				  	  		$("#ssn_selections input").each(function(i, e){
					  	  		//First, clear the list
				  	  			
				  	  			//Repopulate the list with ssns that the user posted to with success
					  	  		if($(e).prop("checked")==true)
					  	  		{
						  	  		var display_name;
						  	  		if($(e).attr("name")=="facebook")
						  	  		{
							  	  		display_name="Facebook";
						  	  		}
					  	  			else if($(e).attr("name")=="googleplus")
					  	  			{
						  	  			display_name="Google+";
					  	  			}
					  	  			else if($(e).attr("name")=="twitter")
					  	  			{
						  	  			display_name="Twitter";
					  	  			}
					  	  			$("#sites_posted_to").append("<li class='ssn_name'>"+display_name+"</li>");
					  	  		}
					  	  	});
					  	  	$("#success_posting").modal("show");
					  	  
				  	  	},
				  	  	error:function(jqXHR, textStatus, errorThrown){
					  	  	//console.dir(jqXHR+textStatus+errorThrown);
					  	  	var error_type=JSON.parse(jqXHR.responseText)["error"];
							//If the user hasn't logged in to one of the selected sites, display a popup asking for log in
					  	  	if(error_type=="facebook")
					  	  	{
						  	  	$("#fb_user_login").modal("show");
					  	  	}
					  	  	else if(error_type=="googleplus")
					  	  	{
					  	  		$("#gp_user_login").modal("show");
						  	}
					  	  	else if(error_type=="twitter")
					  	  	{
					  	  		$("#tw_user_login").modal("show");
					  	  	}
					  	  	else if(error_type=="facebook-posting-failed")
					  	  	{
						  	  	window.location="about.php?error=facebook-posting-failed";
					  	  	}
					  	  	else if(error_type=="twitter-posting-failed")
					  	  	{
					  	  		window.location="about.php?error=twitter-posting-failed";
					  	  	}
					  	  	else if(error-type=="googleplus-posting-failed")
					  	  	{
					  	  		window.location="about.php?error=googleplus-posting-failed";
						  	}
					  	},
					  	complete:function(jqXHR, textStatus){
						}
			  	  	});
		  	  	});

				
	  	  	});
  		</script>
  		
		<title>uPost Social Network Update Manager</title>
	</head>
	
	<body>
		<!-- Login prompts when user has not logged in to one of the selected sns's -->
		<!-- Popup for facebook login -->
		<div class="modal fade" id="fb_user_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">You need to:</h4>
		      </div>
		      <div class="modal-body">
			      <form role="form" action="login.php" method="post" autocomplete="on">
			          <div class="form-group">
			            <input id="fb_login" name="sns" class="btn btn-primary btn-block btn-lg" type="submit" value="login with Facebook" >
			          </div>
			      </form>
			  </div>
		    </div>
		  </div>
		</div>
		
		<!-- Popup for google plus login -->
		<div class="modal fade" id="gp_user_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">You need to:</h4>
		      </div>
		      <div class="modal-body">
			      <form role="form" action="login.php" method="post" autocomplete="on">
			          <div class="form-group">
			            <input id="gp_login" name="sns" class="btn btn-primary btn-block btn-lg" type="submit" value="login with Google+" >
			          </div>
			      </form>
			  </div>
		    </div>
		  </div>
		</div>
		
		<!-- Popup for twitter login -->
		<div class="modal fade" id="tw_user_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">You need to:</h4>
		      </div>
		      <div class="modal-body">
			      <form role="form" action="login.php" method="post" autocomplete="on">
			          <div class="form-group">
			            <input id="tw_login" name="sns" class="btn btn-primary btn-block btn-lg" type="submit" value="login with Twitter" >
			          </div>
			      </form>
			  </div>
		    </div>
		  </div>
		</div>
		
		<!-- Prompt for successful posting -->
	    <div class="modal fade" id="success_posting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">You have successfully posted to the following sites:</h4>
		      </div>
		      <div class="modal-body">
			      <ul id="sites_posted_to">
			        
			      </ul>
			  </div>
		    </div>
		  </div>
		</div>
		
		<!-- Navbar(header) -->
		<nav class="navbar navbar-default fixed-top" role="navigation">
		  <div class="container-fluid">
	        <div class="navbar-header">
	            <a class="navbar-brand" href="index.php">uPOST</a>
	        </div>
	        
	      	<ul class="nav navbar-nav navbar-right">
          		<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account Settings <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="#" onclick="window.location='account.php'">Manage Social Accounts</a></li>
		            <li><a href="#" onclick="window.location='about.php?action=logout'">Log Out</a></li>
		            <li class="divider"></li>
		          </ul>
		        </li>
		    </ul>
		  </div>
		</nav>
		
		<!-- For client-side notifications -->
		<?php include("alert.php");?>
		
		<!-- Main body. Post area -->
		<div class="fluid-container">
			<div class="row">
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			    <div class="col-md-8 panel custom-panel">
			    	<!-- Get the user's current location -->
			    	<script type="text/javascript">
			    	function saveLocation(position)
			    	{
				    	$("#current_loc").html("latitude: "+position.coords.latitude.toFixed(2)+", longitude: "+position.coords.longitude.toFixed(2));
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
				    <form method="post" action="post.php" role="form">
				    
				    	<!-- Text area -->
			    		<div class="form-group">
			    			<label for="post_text">Write something and public everywhere!</label><span class="pull-right">Character count: <span id="char_count">0</span></span>
			    			<textarea id="post_text" name="text" class="form-control" placeholder="Write something in your mind..." rows="5"></textarea>
			    			
			    		</div>
			    		
			    		<!-- Current Location -->
			    		<div class="form-group">
			    		    <div class="row">
			    				<div class="col-sm-6">
			    					<p><span>Your current location: &nbsp;&nbsp;</span><span id="current_loc"></span></p>
			    				</div>
			    				<div class="col-sm-6">
			    				<label class="checkbox-inline">
			    					
			    					<input name="location" type="checkbox" checked>
			    					Enable location posting
			    				</label>
			    				</div>
			    				
			    			</div>
			    		</div>
			    		
			    		<!-- SNS options -->
			    		<div id="ssn_selections" class="form-group">
			    			<!-- Generated dynamically -->
			    			
			    			<img src="Images/Logos/facebook.jpg" height="20">
			    			<label class="checkbox-inline" >
			    				<input id="fb-checkbox" name="facebook" type="checkbox">
			    			</label>
			    			<span>&nbsp;&nbsp;</span>
			    			
			    			<img src="Images/Logos/twitter.jpg" height="20">
			    			<label class="checkbox-inline" >
			    			    <input id="tw-checkbox" name="twitter" type="checkbox">
			    			</label>
			    			<span>&nbsp;&nbsp;</span>
			    			
			    			<img src="Images/Logos/googleplus.jpg" height="20">
			    			<label class="checkbox-inline" >
			    			    <input id="gp-checkbox" name="googleplus" type="checkbox">
			    			</label>
			    			<span>&nbsp;&nbsp;</span>
			    		</div>
			    		
			    		<div class="form-group">
			    			<input id="submit" class="btn btn-default btn-block btn-lg" type="submit" value="uPOST!">
			    		</div>
			    	</form>
			    </div>
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
		</div>
	</body>
</html>