<?php
require_once('config.php');

require_once CLASSES . 'class.utility.php';
require_once CLASSES . 'class.db.php';

$db = new database();

if ( isset($_POST["type"])) {
	$_POST = $db->clean_array($_POST);
	if ( $_POST["type"] === 'join') {
		$idh = md5($_POST["id"].md5($_SESSION["tsa_gong"]));
		$ar = array(
			'idh'=>$idh,
			'username'=>$_POST["username"]
		);
		$_SESSION["notification"][] = $ar;
	} else {
		foreach($_SESSION["notification"] as $key=>$value) {
			foreach($value as $name) {
				if ( $name === $_POST["data"]) {
					unset($_SESSION["notification"][$key]);
				}
			}
		}
	}
}
krsort($_SESSION["notification"]);//Sorting array with key from high to low
foreach($_SESSION["notification"] as $rows) {
	echo "<p><a href=\"particular_one.php?idh=$rows[idh]\">$rows[username]</a><p>";
}
