<?php
session_start();
require_once('config.php');
require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.utility.php';
require_once CLASSES . 'class.user.php';

$db = new database();
$user = new user();

$conditions = "ORDER BY id DESC LIMIT $_POST[from], 10";
$array = $user->get('*', $conditions);
if ( empty($array)) {
	echo 'That all we have online';
}
utility::member($array);
echo '<div stye="display: none;" class="loading"></div>';

