<?php
session_start();
include('config.php');
require_once CLASSES . "class.utility.php";
require_once CLASSES . "class.db.php";
require_once CLASSES . "class.user.php";
require_once CLASSES . "class.likedislike.php";

$db = new database();
$user = new user();
$likedislike = new likedislike();

if( isset($_POST) ) {

	$loginid = $user->match_hash( $_POST["loginidhash"]);
	$likerid = $user->match_hash($_POST["likeridhash"]);

	$idh = md5($loginid.md5($_SESSION["tsa_gong"]));

	$conditions = "WHERE loginid = $loginid && likerid = $likerid && type = $_POST[type]";
	$liked = $likedislikes = $likedislike->get_total_rows($conditions);

	if ( !$liked) {

		$_data = array (
			'loginid' => $loginid,
			'likerid' => $likerid,
			'type' => $_POST["type"]
			);

		$likedislike->add($_data);
	}

	$conditions = "WHERE loginid = $loginid && type = 1";
	$likes = $likedislike->get_total_rows($conditions);
	echo '<span style="color: green; font-family: times new roman, sans-serif; text-transform: uppercase;">'.$likes.' likes, </span>';

	$conditions = "WHERE loginid = $loginid && type = 0";
	$dislikes = $likedislike->get_total_rows($conditions);
	echo '<span style="color: red; font-family: times new roman, sans-serif; text-transform: uppercase;">'.$dislikes.' dislikes</span>';
} 
  

