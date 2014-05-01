uPost
=====

This Readme was last updated on: Thursday, May 1 2014

Focus on what and where to post. uPost takes care of the rest.

uPost is a web application via which users can post content to multiple social media.

We hope uPost can inspire creation instead of plain sharing.

Installation Instructions
=========================

1. ensure that apache is installed and runs.

2. Configure apache2 to serve our website, set the DocumentRoot to the folder this file is in.

3. .htaccess must be enabled, check your version of apache2.

4. Make sure that the API keys in config.php are the ones that you would like to use. The default keys in config.php are the keys 
	used by our live website at http://upost.herokuapp.com/. 

	If you just host this web app as is, THe API keys will not work unless it is being hosted from the exact address http://upost.herokuapp.com/
	Alternatively, you can just use your own keys that are configured they way that you want.

5. you need to configure your php.ini file, the default location is in /etc/
	
	to find the location of your php.ini, run php --ini in the terminal.

	changes:

		Set session.use_trans_sid = 0 in your php.ini file. This will tell PHP not to include the identifier in the URL, and not to read the URL for identifiers.

		Set session.use_only_cookies = 1 in your php.ini file. This will tell PHP to never use URLs with session identifiers.

	these settings are required to prevent session hijacking/fixation attacks 

Misc.
=====

Public Git Repository: https://github.com/Aarons100/uPost

LinkedIn login failed during our presentation because of a new update that LinkedIn pushed to their API about ten minutes before we presented.

LinkedIn now requires a valid Redirect URL (as per oauth 2.0 requirements). They pushed this update on Monday, April 28th 2014 at 5:00 PM EST. When we presented, our Redirect URL was set to http://localhost/ (from development) and the new requirements demanded that the Redirect URL to be http://upost.herokuapp.com/.
