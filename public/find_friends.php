<?php require_once('head.php');

require_once CLASSES . 'class.user.php';
$user = new user();

if ( isset($_POST["search"]) && !empty($_POST["search"])) {

	$_POST = $db->clean_array($_POST);
 
	$conditions = "WHERE gender = $_POST[gender]";
	if ( $_POST["region"] != 'All') {
		$conditions .= " && region = $_POST[region]";
	}
	$conditions .= "ORDER BY id DESC";
	$array = $user->get('*', $conditions);
	utility::member($array, 0);
	die();
}
echo '<p style="text-align: center;"><input type="text" name="search_username" style="width: 300px;" 
	placeholder="Search" onkeyup="search_username(this.value); return false;"/></p>';
echo '<div id="loadmore">';
	$conditions = "ORDER BY id DESC LIMIT 0, 10";
	$array = $user->get('id, username, gender, hobby, image', $conditions); //Loading page one after another first the start page is 0
	utility::member($array, 0);
echo '</div>';
echo "<br/><p style='text-align: center;'><a href='#' class='btn' onclick=\"loadmore(); return false;\">LOAD MORE</a></p>";

$to = "tapaljor@gmail.com";
$subject = "Payment received";
$body = "Payment received on invoice 224";
$headers = "From: tapaljor@gmail.com"."\r\n";
$headers .="Content-type: text/html\r\n";

/*$mail = mail($to, $subject, $body, $headers);
if ( $mail) {
	echo "*ok*";
} else {
	echo 'Email did not go through';
}*/
require_once('footer.php');
