<html>
	<body>
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
	  		
	  		<!-- Facebook Login -->
	  		<!-- Ignore for now, because we are going to implement server-side login -->
	  		<script>
		  	  //Facebook Login
		  	  //The access token to fetch a user's info from facebook
		  	  var access_token;
		  	  window.fbAsyncInit = function() {
		  	  FB.init({
		  	    appId      : '722200331145073',
		  	    status     : true, // check login status
		  	    cookie     : true, // enable cookies to allow the server to access the session
		  	    xfbml      : true  // parse XFBML
		  	  });
	
		  	  //Subscribe to the event when user's login status changed
		  	  FB.Event.subscribe('auth.authResponseChange', function(response) {
		  	    	// Here we specify what we do with the response anytime this event occurs. 
			  	    if (response.status === 'connected') {
			  	      access_token=response["authResponse"]["accessToken"];
			  	      var username="";
			  	      //ajax call to facebook to retrieve the username of that user
			  	      $.ajax({
			  			url:"https://graph.facebook.com/me?fields=id,username",
			  			type:"GET",
			  			dataType:"",
			  			data:{access_token: access_token},
			  			ajax:true,
			  			success: function(data, textStatus, jqXHR){
			  				//getting the username
							username=data["username"];
							//now we have access_token and username
							console.log("facebook access token: "+access_token);
							console.log("username: "+username);
							//
							//
							//
							//
							//
							//
				  		},
				  		error: function(){

					  	}
			  		  });
			  	    }else {
			  	      destroy_data();
			  	    }
			  });
		  	  };
		  	  
	
		  	  // Load the Facebook SDK asynchronously
		  	  (function(d){
		  	   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		  	   if (d.getElementById(id)) {return;}
		  	   js = d.createElement('script'); js.id = id; js.async = true;
		  	   js.src = "//connect.facebook.net/en_US/all.js";
		  	   ref.parentNode.insertBefore(js, ref);
		  	  }(document));
	
		  	  //Prompts the user to login 
		  	  function fb_login()
		  	  {
		  		  FB.login(function(response){
		  			  for(key in response.authResponse)
		  			  {
		  				  console.log(key+": "+response.authResponse[key]);
		  			  }
		  			  for(key in response)
		  			  {
		  				  console.log(key+": "+response[key]);
		  			  }
		  		  	  
		  		  }, {scope: 'email,publish_actions'});
		  	  }
	  		</script>
	  		
	  		<!-- Twitter login -->
	  		<scipt>
	  		</script>
	  		
	  		<!-- Store the user name and access tokens -->
	  		
	  		
	  		<script>
	  		$(document).ready(function(){
		  	  
	  		  $("#fb_login").on("click", function(e){
	  			//e.preventDefault();
	  			//fb_login();
		  	  });
	  		});
	  		</script>
	  		
	  		<link rel="stylesheet" href="Styles/general.css">
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
		      
		      <form role="form" action="login.php" method="post" autocomplete="on">
		        <div class="modal-body">
		          <div class="form-group">
		            <label>Username(email):</label>
		            <input name="username" class="form-control" type="text">
		          </div>
		          <div class="form-group">
		            <label>Password:</label>
		            <input name="password" class="form-control" type="password">
		          </div>
		        </div>
		        <div class="modal-footer">
		          <div class="form-group">
		            <input id="fb_login" name="sns" class="btn btn-primary" type="submit" value="login with Facebook">
		          	<input id="tw_login" name="sns" class="btn btn-primary" type="submit" value="login with Twitter">
		          	<input id="gp_login" name="sns" class="btn btn-primary" type="submit" value="login with Google+">
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
		        <h4 class="modal-title" id="myModalLabel">Register</h4>
		      </div>
		      <form role="form">
		      
		        <div class="modal-body">
		          <div class="form-group">
		            <label>Username:</label>
		            <input class="form-control" type="text">
		          </div>
		          <div class="form-group">
		            <label>Password:</label>
		            <input class="form-control" type="password">
		          </div>
		        </div>
		        <div class="modal-footer">
		          <div class="form-group">
		            <input class="btn btn-primary" type="submit" value="register with Facebook" >
		            <input class="btn btn-primary" type="submit" value="register with Twitter" >
		            <input class="btn btn-primary" type="submit" value="register with Google+" >
		          </div>
		        </div>
		      </form>
		    </div>
		  </div>
		</div>
		
		<!-- Nav header -->
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
		<!-- For client-side notifications -->
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
</html>
