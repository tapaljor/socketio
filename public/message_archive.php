<?php 
require_once('head.php'); 

require_once CLASSES . 'class.chat.php';
require_once CLASSES . 'class.user.php';

$chat = new chat();
$user = new user();
?>

<input type="hidden" id="handle" value="<?php echo $_SESSION["idCHATP"];?>"/>
<input type="hidden" id="user" value="<?php echo $_SESSION["AdminCHATP"];?>"/>

<?php
$count = 1;
$array = $chat->get('count(id), source', "WHERE destination = $_SESSION[idCHATP] && status != 2 GROUP BY source");
if ( empty($array)) {
	die('No new message');
}
foreach($array as $rows) {

	$idh = md5($rows["source"].md5($_SESSION["tsa_gong"]));
	$array1 = $user->get("username", "WHERE id = $rows[source]");
	foreach($array1 as $rows1) {
		echo "<br/><a href=\"home.php?destinationh=$idh\" class='btn'>".$count.'. '.$rows1["username"].' ('.$rows["count(id)"].')</a><br/>';
		$count++;
	}
}
require_once('footer.php');
