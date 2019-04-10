<?php
require_once('head.php');

require_once CLASSES . 'class.user.php';
require_once CLASSES . 'class.chat.php';

$user = new user();
$chat = new chat();

if ( isset($_GET["destinationh"]) && !empty($_GET["destinationh"])) {
	
	$id = $user->match_hash($_GET["destinationh"]);
	$array = $user->get('username', "WHERE id = $id");
	foreach($array as $rows) {
		$username = $rows["username"];
	}
?>
	<fieldset id="output">
	<legend align="left"><?php echo $username;?></legend>
	<?php
	$array = $chat->get('*', "WHERE destination = $_SESSION[idCHATP] || source = $_SESSION[idCHATP] ORDER BY time DESC");
	foreach($array as $rows) {

		$array1 = $user->get('username', "WHERE id = $rows[source]");
		foreach($array1 as $rows1) {
			$from = $rows1["username"];
		}
		if ( $from === $_SESSION["AdminCHATP"]) {
			$from = 'you';
		}
		echo '<p><b>'.$from.': </b><i>'.$rows["message"].'</i></p>';
	}
	$chat->execute("status = 2 WHERE destination = $_SESSION[idCHATP] && source = $id");//Marking message as read
	?>
	</fieldset>
	<form id="messageform">
		<input type="hidden" id="handle" value="<?php echo $_SESSION["idCHATP"];?>"/>
		<input type="hidden" id="user" value="<?php echo $_SESSION["AdminCHATP"];?>"/>
		<input type="hidden" id="destination" value="<?php echo $id;?>"/>
		<input type="text" id="message" placeholder="Message"/>
		<button id="send"><div id="feedback">Send</div></button>
	</form>
<?php
} else {
	header('Location: welcome.php');
}
require_once('footer.php');?>
