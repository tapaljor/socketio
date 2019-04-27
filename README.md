## Socketio Websocket using Node.js and PHP

### Requirements
<ul>
	<li> Node</li>
	<li> express </li>
	<li> socket.io </li>
	<li> LAMP 
		<ul>
	 	<li> In Linux (Ubuntu) install as <i>sudo apt-get install lamp-server^</i></li>
		<li> In Windows install LAMP after downloading WAMP from <i>http://www.wampserver.com/en/</i></li>
		</ul>
	</li>
</ul>

### Change your IP address 
<ul>
<li> Go to public/chat.js, public/connect.js</li>
<li> Replace localhost/given IP with your own IP address</li>
</ul>

### Create database and import
<ul>
<li> Create database `chat` with username and password 'chat'</li>
<li> Import SQL database from `chat-YYYY-mm-dd.sql` into your `chat` database</li>
<li> Change database username and password in public/config.php</li>
</ul>

### Granting permission to use uploads directory
<ul>
<li> There is uploads directory in public/
Occassionally you have to give permission to upload image into this directory.
</li>
</ul>
 
### Run server on with command: node index.js

