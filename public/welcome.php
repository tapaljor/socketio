<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"></script>
<link rel="stylesheet" href="css/styles.css"/>
</head>
<?php 
session_start();
require_once('config.php');
require_once CLASSES.'class.db.php';
require_once CLASSES.'class.user.php';

$db = new database();
$user = new user();

echo "<input type='hidden' id='user' value=\"$_SESSION[AdminCHATP]\"/>";
echo "<input type='hidden' id='id' value=\"$_SESSION[idCHATP]\"/>";
if ( isset($_GET["logout"]) && !empty($_GET["logout"])) {

	$_GET = $db->clean_array($_GET);

	$data = array(
		'id'=> $_SESSION["idCHATP"],
		'status'=>0
	);
	$user->update($data);
	echo "<input type='hidden' id='type' value='logout'/>";
	echo '<p style="padding: 1em; font-size: 2em; text-align: center;">Thank you '.strtoupper($_SESSION["AdminCHATP"]).'. Visit again</p>';
	echo '<p style="text-align: center; margin-top: 2em;"><a href="index.php" class="btn"> Sign out</a></p>';
	session_destroy();
} else {
	$_SESSION["notification"] = array();
	$array = $user->get("MD5(CONCAT(id,MD5('$_SESSION[tsa_gong]'))) AS idh, username", "WHERE status = 2");
	$_SESSION["notification"] = $array;

	echo "<input type='hidden' id='type' value='login'/>";
	echo '<p style="padding: 1em; font-size: 2em; text-align: center;">Welcome '.strtoupper($_SESSION["AdminCHATP"]).' to TibetChat</p>';
	echo '<p style="text-align: center; margin-top: 2em;"><a href="find_friends.php" class="btn"> Enter</a></p>';
}
?>
<script src="connect.js"></script>
