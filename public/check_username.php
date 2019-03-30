<?php
require_once('config.php');
require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.user.php';

$db = new database();
$user = new user();

$users = $user->get_num_rows("WHERE username = '$_POST[username]'");
if ( $users > 0 ) {
	echo '<span style="color: red;">Username is already taken</span>';
} else {
	echo '<span style="color: green;">Username available</span>';
}	

