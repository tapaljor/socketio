<?php require_once('head.php');

require_once CLASSES.'class.user.php';

$user = new user();

echo "<input type='hidden' id='user' value=\"$_SESSION[AdminCHATP]\"/>";

if ( isset($_GET["logout"]) && !empty($_GET["logout"])) {

	$data = array(
		'id'=> $_SESSION["idCHATP"],
		'status'=>0
	);
	$user->update($data);

	echo "<input type='hidden' id='type' value='logout'/>";
	echo '<p style="font-size: 2em; text-align: center;">Thank you '.strtoupper($_SESSION["AdminCHATP"]).'. Visit again</p>';
	echo '<p style="text-align: center; margin-top: 2em;"><a href="index.php" class="btn"> Sign out</a></p>';
	session_destroy();
} else {
	echo "<input type='hidden' id='type' value='login'/>";
	echo '<p style="font-size: 2em; text-align: center;">Welcome '.strtoupper($_SESSION["AdminCHATP"]).' to TibetChat</p>';
	echo '<p style="text-align: center; margin-top: 2em;"><a href="find_friends.php" class="btn"> Enter</a></p>';
}
?>
<script src="connect.js"></script>
