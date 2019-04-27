# socketio
Websocket using Node.js and PHP

Requirements: 
	- Node
	- express 
	- socket.io 
	- LAMP 
	 	- In Linux install as sudo apt-get install lamp-server^
		- In Windows install LAMP after downloading WAMP from http://www.wampserver.com/en/

//Change your IP address accordingly
1. Go to public/chat.js, public/connect.js
2. Replace localhost with your IP address

//Create database and import
1. Create database `chat` with username and password 'chat'
2. Import SQL database from `chat-YYYY-mm-dd.sql' into your `chat` database
3. Change database username and password in public/config.php

//Granting permission to use uploads directory
There is uploads directory in public/
Occassionally you have to give permission to upload image into this directory.
 
Run server on with command: node index.js

