<?php require('head.php'); 

require_once CLASSES . 'class.user.php';
$user = new user();

if ( isset($_POST["search"]) && !empty($_POST["search"])) {

	$_POST = $db->clean_array($_POST);
 
	$conditions = "WHERE gender = $_POST[gender]";
	if ( $_POST["region"] != 'All') {
		$conditions .= " && region = $_POST[region]";
	}
 	$conditions .= "ORDER BY id DESC";
 	$array = $user->get('*', $conditions);
 	utility::member($array, 0);
 	die();
}
echo '<div id="loadmore">';
	$conditions = "WHERE status = 2 ORDER BY id DESC LIMIT 0, 2";
 	$array = $user->get('*', $conditions); //Loading page one after another first the start page is 0
 	utility::member($array, 0);
echo '</div>';
echo "<a href='#' class='btn' onclick=\"loadmore(); return false;\">LOAD MORE</a>";
require('footer.php');?>
