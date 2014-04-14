<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		
  		<style>
  		
  		</style>
  		
  		<!-- Jquery -->
  		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  		
  		<!-- Bootstrap -->
  		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
  		<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">
  		<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  		<link type="text/css" rel="stylesheet" href="Styles/general.css">
  		
		<title> Manage your account</title>
	</head>
	
	<?php //if (isset($_SESSION["user"])):?>
	<body>
		<div class="fluid-container">
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
			    	<form role="form">
			    		<div class="form-group">
			    			<label for="change_password">Change your username: </label>
			    			<input id="change_username" class="form-control" type="text" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="btn btn-default" type="submit" value="OK">
			    		</div>
			    	</form>
			    	<form role="form">
			    		<div class="form-group">
			    			<label for="change_password">Change your password: </label>
			    			<input id="change_password" class="form-control" type="password" required>
			    			<label for="change_password_again">Type it again: </label>
			    			<input id="change_password_again" class="form-control" type="password" required>
			    			<label for="old_password">Type your old password: </label>
			    			<input id="old_password" class="form-control" type="password" required>
			    		</div>
			    		<div class="form-group">
			    			<input class="btn btn-default" type="submit" value="OK">
			    		</div>
			    	</form>
			    </div>
			    <div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
			<div class="row">
				<div class="col-md-2 hidden-sm hidden-xs"></div>
				<div class="col-md-8 panel custom-panel">
					<div class="row">
						<div class="col-md-3">
							<img class="img-responsive" src="Images/Logos/facebook.jpg" >
						</div>
						<div class="col-md-6">
							<form role="form">
								<div class="form-group">
									<label>Username:</label>
									<input class="form-control" type="text">
								</div>
								<div class="form-group">
									<label>Password:</label>
									<input class="form-control" type="password">
								</div>
								<div class="form-group">
									<input class="btn btn-default btn-block" type="submit" value="login">
								</div>
							</form>
						</div>
						<div class="col-md-3">
							<p>Login status:</p>
							<p>Logged in</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
			<div class="row">
				<div class="col-md-2 hidden-sm hidden-xs"></div>
				<div class="col-md-8 panel custom-panel">
					<div class="row">
						<div class="col-md-3">
							<img class="img-responsive" src="Images/Logos/twitter.jpg" >
						</div>
						<div class="col-md-6">
							<form role="form">
								<div class="form-group">
									<label>Username:</label>
									<input class="form-control" type="text">
								</div>
								<div class="form-group">
									<label>Password:</label>
									<input class="form-control" type="password">
								</div>
								<div class="form-group">
									<input class="btn btn-default btn-block" type="submit" value="login">
								</div>
							</form>
						</div>
						<div class="col-md-3">
							<p>Login status:</p>
							<p>Logged in</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
		</div>
	</body>