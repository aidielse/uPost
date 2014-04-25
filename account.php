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
  		<link type="text/css" rel="stylesheet" href="Styles/general.css">
  		
		<title> Manage Your Account</title>
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
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account Settings <b class="caret"></b></a>
			          <ul class="dropdown-menu">
			            <li><a href="#" onclick="window.location='account.php'">Manage Social Accounts</a></li>
			            <li><a href="#" onclick="window.location='about.php?action=logout'">Log Out</a></li>
			            <li class="divider"></li>
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
					<div class="row">
						<div class="col-md-3">
							<img class="img-responsive" src="Images/Logos/facebook.jpg" >
						</div>
						<div class="col-md-6">
							<form role="form">
								<div class="form-group">
									<input id="fb_login" name="sns" class="btn btn-primary btn-block" type="submit" value="login with Facebook">
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
							<form role="form" action="login.php" method="post" autocomplete="on">
					            <div class="form-group">
					              <input id="tw_login" name="sns" class="btn btn-primary btn-block" type="submit" value="login with Twitter">
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
							<img class="img-responsive" src="Images/Logos/google+.jpg" >
						</div>
						<div class="col-md-6">
							<form role="form" action="login.php" method="post" autocomplete="on">
					            <div class="form-group">
					              <input id="gp_login" name="sns" class="btn btn-primary btn-block" type="submit" value="login with Google+">
					            </div>
					        </form>
						</div>
						<div class="col-md-3">
							<p>Login status:</p>
							<p>Logged in</p>
						</div>
						</div>
					</div>
				</div>
				<div class="col-md-2 hidden-sm hidden-xs"></div>
			</div>
		</div>
	</body>