<?php 

require_once('config.php');
require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.chat.php';

$db = new database();
$chat = new chat();

$_POST["time"] = time();

$chat->add($_POST);
