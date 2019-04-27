<?php
require_once('config.php');

require_once CLASSES . 'class.utility.php';
require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.user.php';

$db = new database();
$user = new user();

$_POST = $db->clean_array($_POST);

$conditions = "WHERE username LIKE '%$_POST[ming]%'";
$array = $user->get('id, username, gender, hobby, image', $conditions);
utility::member($array);
