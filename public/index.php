<?php session_start();?>
<html>
<head>
	<title>Tibet Chat</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"></script>
	<link rel="stylesheet" href="css/login.css"/>
</head>
<body>
<?php

require_once('config.php');
require_once CLASSES . 'class.utility.php';
require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.user.php';

$db = new database();
$user = new user();

if ( empty($_SESSION["tsa_gong"])) {
	$_SESSION["tsa_gong"] = utility::create_token();
}

if ( isset($_POST["login"]) && !empty($_POST["login"])) {

	$_POST = $user->clean_array($_POST);

	$status = false;
	$status = $user->check_login($_POST["username"], $_POST["password"]);
	if ( $status) {
		$data = array(
			'id'=>$_SESSION["idCHATP"],
			'status'=>2
		);
		$user->update($data);
		header('Location: home.php');
	} else {
		echo 'access denied';
	}
}

?>
<form action="index.php" method="POST">
	<h1>LOGIN</h1>
	<input type="text" name="username" placeholder="Username" required="required"/>
	<input type="password" name="password" placeholder="Password" required="required"/>
	<input type="submit" name="login" value="LOGIN"/>
	<a href="upload.php?add=38476dkfhghd2">REGISTER</a>
</form>
</body>
</html>
