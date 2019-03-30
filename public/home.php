<?php
require('head.php');

if ( isset($_GET["logout"]) && !empty($_GET["logout"])) {

	session_destroy();
	header('Location: index.php');
} 
?>	
	<div style="height: 60px;"></div>
	<div id="notification"></div>
	<div id="output">
	</div>
	<form id="messageform">
		<input type="hidden" id="handle" value="<?php echo $_SESSION["AdminCHATP"];?>"/>
		<input type="text" id="message" placeholder="Message"/>
		<button id="send"><div id="feedback">Send</div></button>
	</form>
</div>
<script src="chat.js"></script>

<?php require('footer.php');?>
