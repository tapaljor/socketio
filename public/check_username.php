<?php
require_once('config.php');
require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.user.php';

$db = new database();
$user = new user();

$_POST = $db->clean_array($_POST);

if ( !ctype_alnum($_POST["username"])) {
	echo json_encode(array('success'=> 3));
} else {
	$users = $user->get_num_rows("WHERE username = '$_POST[username]'");
	if ( $users > 0 ) {
		echo json_encode(array('success'=> 0));
	} else {
		echo json_encode(array('success'=> 1));
	}	
}

