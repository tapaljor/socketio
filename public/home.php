<?php
require('head.php');

require_once CLASSES . 'class.user.php';

$user = new user();

if ( isset($_GET["logout"]) && !empty($_GET["logout"])) {

	session_destroy();
	$data = array(
		'id'=> $_SESSION["idCHATP"],
		'status'=>0
	);
	$user->update($data);

	session_destroy();
	header('Location: index.php');
}
if ( isset($_GET["destinationh"]) && !empty($_GET["destinationh"])) {
	
	$id = $user->match_hash($_GET["destinationh"]);
	$array = $user->get('username', "WHERE id = $id");
	foreach($array as $rows) {
		$username = $rows["username"];
	}
	echo '<p style="text-transform: uppercase;">'.$username.'</p>';
?>	
	<div id="notification"></div>
	<div id="output">
	</div>
	<form id="messageform">
		<input type="hidden" id="handle" value="<?php echo $_SESSION["idCHATP"];?>"/>
		<input type="hidden" id="user" value="<?php echo $_SESSION["AdminCHATP"];?>"/>
		<input type="hidden" id="destination" value="<?php echo $id;?>"/>
		<input type="text" id="message" placeholder="Message"/>
		<button id="send"><div id="feedback">Send</div></button>
	</form>
	<script src="chat.js"></script>
<?php
} else {
	header('Location: findfriends.php');
}
?>

<?php require('footer.php');?>
