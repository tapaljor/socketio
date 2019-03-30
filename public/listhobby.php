<?php 

include("head.php");

//getting page number to avoid repetion
$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

require_once CLASSES."class.$page.php";

$object = new $page();

if ( !utility::is_admin()) {
	die('<div id="file_error">Limited right, consult admin</div>');
}

if ( utility::check_authentication() && isset($_GET["add_$page"]) && !empty($_GET["add_$page"])) {

	echo <<<HERE
	<div class="body body-s">
	<form action="$page.php" method="POST" class="sky-form">
		<header>Add $page</header>
		<fieldset>
		<section class="col col-6">
			<label class="input">
			<input type="text" name="name" placeholder="Enter $page" required="required"/>
			</label>
		</section>
		<section class="col col-6">
			<input type="submit" name="save" class="button" value="Save">
		</section>
		</fieldset>
	</form>
	</fieldset>
HERE;
	die();
}
if ( isset($_GET["delete"])) {

	$_GET = $db->clean_array($_GET);
	$id = $object->match_hash($_GET["delete"]);

	$status = false;
	$status = $object->delete($id);

	if($status) {
		header("Location: $page.php");
	} else {
		echo '<p style="color: #fff;">Error: cannot delete</p>';
	}
}
if(isset($_POST["save"]) && !empty($_POST["save"]) ) {

	$_POST = $db->clean_array($_POST);

	unset($_POST["save"]);

	$status = false;
	$status = $object->add($_POST);

	if($status) {
		header("Location: $page.php");
	} else {
		echo '<p color: #fff;">Error: cannot upload</p>';
	} 
}
if( isset($_POST["update"]) ) {

	$_POST = $db->clean_array($_POST); 

	unset($_POST["update"]);

	$status = false;
	$status = $object->update($_POST);

	if($status) {
		header("Location: $page.php");
	} else {
		echo '<p style="color: #fff;">Error: cannot update</p>';
	}
}
if( isset($_GET["edit"]) ) {

	$_GET = $db->clean_array($_GET);

	$id = $object->match_hash($_GET["edit"]);

	$array = $object->get('*', "WHERE id = $id");
	foreach($array as $rows) {

		echo '<div class="body body-s">';
		echo "<form action=\"$page.php\" method='POST' class='sky-form'>";
			echo "<header>Edit $page</header>";
			echo '<fieldset>';
			echo "<input type=\"hidden\" name=\"id\" value=\"$rows[id]\"/>";

			echo "<section>$page:</section>";
			echo '<section class="col col-6"><label class="input">';
			echo "<input type='text' name='name' value=\"$rows[name]\"/>";
			echo '</label></section>';

			echo '<section class="col col-6">';
			echo '<input type="submit" name="update" class="button" value="Update"/>';
			echo '</section>';
		echo '</form></fieldset></div>';
	}
	die();
} else {

	echo '<div class="body body-s">';
	echo '<form class="sky-form">';
	echo "<header>#.....$page</header>";
	$counter = 1;

	$array = $object->get("ORDER BY id DESC");
	foreach($array as $rows) {

		$idh = md5($rows["id"].md5($_SESSION["tsa_gong"]));

		echo '<fieldset>';
		echo "<section class='col col-1'>".$counter++.'</section>';
		echo "<section class='col col-6'><label class='input'>".$rows["name"].'</label></section>';

		echo '<section class="col col-4">';
		if ( utility::check_authentication()) {
			echo "<a href=\"$page.php?edit=$idh\" style=\"color: green;\"/>Edit/</a>";
			echo "<a href=\"$page.php?delete=$idh\" style=\"color: red;\" 
				onclick=\"return confirm('Are you sure you want to delete $rows[name]? Please make sure you did not assign $rows[name] to any data.');\"/>Delete</a>";
		}
		echo '</section>';
		echo '</fieldset>';
	}
	echo "<footer><a href=\"$page.php?add_$page=yes\"><input type='button' class='button' value=\"Add $page\"/></a></footer>";
	echo '</form></div>';
}

include("footer.php");
