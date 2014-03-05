<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		
  		<style>
  		.icon-bar{
  			display: block;
			width: 22px;
			height: 2px;
			border-radius: 1px;
			background-color: #888;
			margin-top: 4px;
  		}
  		
  		.custom-panel{
  			padding: 10px;
      		border-radius: 0px;
      		box-shadow:5px 5px 5px grey;
      		border:solid #e7e7e7 1px;
      		text-align:center;
      		-webkit-transition: -webkit-transform 1s, box-shadow 1s;
      		transition: transform 1s, box-shadow 1s;
      		
  		}
  		.custom-panel:not(:first-child){
  			margin-top: 30px;
  		}
  		
  		.custom-panel:hover{
  			box-shadow:0px 0px 0px grey;
  			-webkit-transform: translate(5px,8px);
  			transform: translate(5px, 8px);
  		}
  		</style>
  		
  		<!-- Jquery -->
  		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  		
  		<!-- Bootstrap -->
  		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
  		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
  		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  		
  		
		<title> uPost Social Network Update Manager</title>
	</head>

<?php if(!isset($_SESSION["user"])): ?>
	<body>
		<div class="fluid-container">
		    <div class="navbar navbar-default fixed-top" role="navigation">
		        <div class="navbar-header">
		            <a class="navbar-brand" href="index.php">uPOST</a>
		          	
		        </div>
		        
		        <ul class="nav navbar-nav navbar-right">
		        	<li><a href="#">Login</a></li>
		        	<li><a href="#">Register</a></li>
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
		<div class="fluid-container">
			<div class="row">
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			    <div class="col-md-8 .panel custom-panel">
			    	<h1>What is uPOST?</h1>
			    	<p>Focus on what and where to post. uPost takes care of the rest.</p>
					<p>uPost is a web application via which users can post content to multiple social media.</p>
					<p>We hope uPost can inspire creation instead of plain sharing.</p>
			    </div>
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
			<div class="row" id="contactus">
				<div class="col-md-2 hidden-sm hidden-xs"></div>
			    <div class="col-md-8 .panel custom-panel">
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
			    <div class="col-md-8 .panel custom-panel">
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
		<div>
			<p>You are logged in!</p>
		</div>
	</body>
<?php endif;?>
</html>