

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
<!-- An alert triggered when user successfully logs in with google+ -->
<div id="google+" class="alert alert-success alert-dismissable" hidden>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>You have successfully logged in with your google+ account!</p>
</div>

<script>
	function getParameterByName(name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	
	if(getParameterByName("error")!="")
	{
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
	else if(getParameterByName("login")=="google+")
	{
		$("#google+").slideDown(300);
	}
</script>