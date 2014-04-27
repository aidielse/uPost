uPost
=====

Focus on what and where to post. uPost takes care of the rest.

uPost is a web application via which users can post content to multiple social media.

Additional features to be added:
Fetching posts, feeds, updates from social media sites

We hope uPost can inspire creation instead of plain sharing.

Installation Instructions
=========================

1. ensure that both apache is installed and running.

2. Configure apache2 to serve our website, set the DocumentRoot to the folder this file is in.

3. .htaccess must be enabled, check your version of apache2.

4. Make sure that the API keys in config.php are the ones that you would like to use.

5. you need to configure your php.ini file, the default location is in /etc/
	
	to find the location of your php.ini, run php --ini in the terminal.

	changes:

		Set session.use_trans_sid = 0 in your php.ini file. This will tell PHP not to include the identifier in the URL, and not to read the URL for identifiers.

		Set session.use_only_cookies = 1 in your php.ini file. This will tell PHP to never use URLs with session identifiers.

	these settings are required to prevent session hijacking/fixation attacks 