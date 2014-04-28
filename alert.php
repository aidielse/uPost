<!-- A collection of alerts that provide users and developers of what went wrong or what's going on -->

<!-- An alert that provides debug information -->
<div id="debug" class="alert alert-warning alert-dismissable" hidden>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>Something went wrong!</p>
</div>
<!-- An alert that provides login and register result (including logging in SNSs)-->
<div id="user_alert" class="alert alert-warning alert-dismissable" hidden>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>Something went wrong!</p>
</div>
<!-- An alert triggered when user successfully logs in with facebook -->
<div id="facebook" class="alert alert-success alert-dismissable" hidden>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>You have successfully logged in with your facebook account!</p>
</div>
<!-- An alert triggered when user successfully logs in with twitter -->
<div id="twitter" class="alert alert-success alert-dismissable" hidden>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>You have successfully logged in with your twitter account!</p>
</div>
<!-- An alert triggered when user successfully logs in with twitter -->
<div id="linkedin" class="alert alert-success alert-dismissable" hidden>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>You have successfully logged in with your linkedin account!</p>
</div>

<script>
	//If the paramter is not defined, it reutrns an empty string
	function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	//Deal with different cases of errors
	if(getParameterByName("error")!="" && getParameterByName("error")=="failed-getting-short-term-token-facebook")
	{
		$("#debug p").html("Failed to obtain short term token from facebook");
		$("#debug").slideDown(300);
	}
	else if(getParameterByName("error")!="" && getParameterByName("error")=="failed-getting-long-term-token-facebook")
	{
		$("#debug p").html("Failed to obtain long term token from facebook");
		$("#debug").slideDown(300);
	}
	else if(getParameterByName("error")!="" && getParameterByName("error")=="login-timed-out-twitter")
	{
		$("#user_alert p").html("Login timed out, please try again");
		$("#user_alert").slideDown(300);
	}
	else if(getParameterByName("error")!="" && getParameterByName("error")=="user-denied-twitter")
	{
		$("#user_alert p").html("You denied the app for posting for you");
		$("#user_alert").slideDown(300);
	}
	else if(getParameterByName("error")!="" && getParameterByName("error")=="char-count-excceeds")
	{
		$("#user_alert p").html("Your character count must not excceed 144 if you want to post to Twitter");
		$("#user_alert").slideDown(300);
	}
	else if(getParameterByName("error")!="" && getParameterByName("error")=="all-off")
	{
		$("#user_alert p").html("You must select at least one site to post to");
		$("#user_alert").slideDown(300);
	}
	else if(getParameterByName("error")!="" && getParameterByName("error")=="facebook-posting-failed")
	{
		$("#user_alert p").html("Some error occurred while posting to some social network sites");
		$("#user_alert").slideDown(300);
	}
	else if(getParameterByName("error")!="" && getParameterByName("error")=="twitter-posting-failed")
	{
		$("#user_alert p").html("Some error occurred while posting to some social network sites");
		$("#user_alert").slideDown(300);
	}
	else if(getParameterByName("error")!="" && getParameterByName("error")=="unknown")
	{
		$("#user_alert p").html("An unknown error has occurred. Please contact us for further assistance");
		$("#user_alert").slideDown(300);
	}
	

	
	if(getParameterByName("login")=="facebook")
	{
		$("#facebook").slideDown(300);
	}
	else if(getParameterByName("login")=="twitter")
	{
		$("#twitter").slideDown(300);
	}
	else if(getParameterByName("login")=="linkedin")
	{
		$("#linkedin").slideDown(300);
	}
	
</script>