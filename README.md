This is a  PHP sample code to test OAUTH 2.0

Before you start using the code make sure the constants in the config file has proper value sets

how you get the values:

1) clone the code to your web root directory  
2) go to google API console 
	https://code.google.com/apis/console
3) create an application
4) put the callback page asked
	(http://localhost/<foldername>/callback.php)
5) you get the client_id and client_secret on successful app creation.

Thats it :)

Once the	set up is done we are ready to run the process.

go to browser and type
http://localhost/index.php

On the back-end the third party application get the delegate authentication using OAuth2.0 to get the profile info.
(ofcourse without sharing your username/password).