uPost
=====

Focus on what and where to post. uPost takes care of the rest.

uPost is a web application via which users can post content to multiple social media.

We hope uPost can inspire creation instead of plain sharing.

Installation Instructions
=========================

1. ensure that both mysql and apache are installed. uPost requires a working mysql database.

2. run mysql, pipe in the db-init.sql file located in /RESOURCES/Database/db-init.sql.

	mysql < db-init.sql

3. Configure apache2 to serve our website, set the DocumentRoot to the current folder.

4. Make sure that the mysql username, password, and hosts variables in the config.php file are set correctly.
	Also, make sure that the API keys in config.php are the ones that you would like to use.

5. you need to configure your php.ini file, the default location is in /etc/
	
	to find the location of your php.ini, run php --ini in the terminal.

	changes:

		Set session.use_trans_sid = 0 in your php.ini file. This will tell PHP not to include the identifier in the URL, and not to read the URL for identifiers.

		Set session.use_only_cookies = 1 in your php.ini file. This will tell PHP to never use URLs with session identifiers.

	these settings are required to prevent session hijacking/fixation attacks 