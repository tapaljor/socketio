<?php
session_start();

require_once('config.php');
require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.user.php';

$db = new database();
$user = new user();

$data = array(
	'id'=>$_SESSION["idCHATP"],
	'status'=>0
);
$user->update($data);
session_destroy();
