<?php session_start();?>
<html>
<head>
	<title>Tibet Chat</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="js/custom.js"></script>
	<link rel="stylesheet" href="css/styles.css"/>
	<link rel="stylesheet" href="css/menu.css"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
require_once('config.php');
require_once CLASSES . 'class.utility.php';
require_once CLASSES . 'class.db.php';

$db = new database();

if (!isset($_SESSION["AdminCHATP"]) || empty($_SESSION["AdminCHATP"])) {
	header('Location: index.php');
}
?>
<body>
<div id="header">
	<?php require_once('menu.php');?>
</div>
<div id="main">
<div id="notification"><?php require_once('notification.php');?></div>
<input type="hidden" id="handle" value="<?php echo $_SESSION["idCHATP"];?>"/>
<input type="hidden" id="user" value="<?php echo $_SESSION["AdminCHATP"];?>"/>
<div id="content">

