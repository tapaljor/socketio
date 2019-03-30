<?php include("head.php");?>
<?php
require_once CLASSES . 'class.listcountry.php';
require_once CLASSES . 'class.listregion.php';

$listcountry = new listcountry($db);
$listregion = new listregion($db);

utility::is_admin();

if ( utility::check_authentication() && isset($_GET["add_listregion"]) && !empty($_GET["add_listregion"])) {

	echo <<<HERE
	<div class="body body-s">
	<form action="listregion.php" method="POST" class="sky-form">
		<header>Add region</header>
		<input type="hidden" name="action" value="Add region"/>
		<fieldset>
		<section>
			<label class="select">
			<select name="countrycode">
			<option>Select country</option>
HERE;
		$array = $listcountry->get();
		foreach($array as $rows) {
			echo "<option value=\"$rows[code]\">$rows[name]</option>";
		}
		
		echo <<<HERE
			</select>
		</section>

		<section>
			<label class="input">
			<input type="text" name="name" placeholder="Region name"/>
			</label>
		</section>
		</fieldset>
		<footer>
 			<input type="submit" name="save" class="button" value="Save">
		</footer>
	</form>
	</fieldset>
HERE;
	die();
}
if ( isset($_GET["delete"])) {

	$_GET = $db->clean_array($_GET);
	$id = $listregion->match_hash($_GET["delete"]);

	$status = false;
	$status = $listregion->delete("WHERE id = $id");

	if($status) {
		header("Location: listregion.php");
	} else {
		echo '<p style="color: #fff;">Error: cannot delete</p>';
	}
}
if(isset($_POST["save"]) && !empty($_POST["save"]) ) {

	$_POST = $db->clean_array($_POST);

	$status = false;
	$status = $listregion->add($_POST);

	if($status) {
		header('Location: listregion.php');
	} else {
		echo '<p color: #fff;">Error: cannot upload region</p>';
	} 
}
if( isset($_POST["update"]) ) {

	$_POST = $db->clean_array($_POST); 

	$status = false;
	$status = $listregion->update($_POST);

	if($status) {
		header('Location: listregion.php');
	} else {
		echo '<p style="color: #fff;">Error: cannot update</p>';
	}
}
if( isset($_GET["edit"]) ) {

	$_GET = $db->clean_array($_GET);

	$id = $listregion->match_hash($_GET["edit"]);
	utility::is_numeric($id);

	$array = $listregion->get("WHERE id = $id");
	foreach($array as $rows) {

		echo '<div class="body body-s">';
		echo '<form action="listregion.php" method="POST" class="sky-form">';
			echo '<header>Edit</header>';
			echo '<fieldset>';
			echo "<input type=\"hidden\" name='action' value='Edit region type'/>";
			echo "<input type=\"hidden\" name=\"id\" value=\"$rows[id]\"/>";

			echo '<section>Country:</section>';
			echo '<section><label class="select">';
			echo '<select name="countrycode">';
			$array = $listcountry->get("WHERE code = '$rows[countrycode]'");
			foreach($array as $rows1) {
				echo "<option value=\"$rows1[code]\">$rows1[name]<option>";
			}
			$array = $listcountry->get();
			foreach($array as $rows1) {
				echo "<option value=\"$rows1[code]\">$rows1[name]<option>";
			}
			echo '</select>';
			echo '</label></section>';

			echo '<section>Region:</section>';
			echo '<section><label class="input">';
			echo "<input type='text' name='name' value=\"$rows[name]\"/>";
			echo '</label></section>';

			echo '</fieldset>';
			echo '<footer>';
			echo '<input type="submit" name="update" class="button" value="Update"/>';
			echo '</footer>';
		echo '</form></fieldset></div>';
	}
	die();
} else {

	$array = $listregion->get("ORDER BY countrycode ASC");

	echo '<div class="body body-s">';
	echo '<form class="sky-form">';
	echo '<header>Region</header>';
	echo '<fieldset>';

	echo "<div class='row'><section class='col col-1'><label class='input'><b>#</b></label></section>";
	echo "<section class='col col-3'><label class='input'><b>Country</b></label></section>";
	echo "<section class='col col-3'><label class='input'><b>Region</b></label></section>";
	echo "<section class='col col-3'><label class='input'><b>#</b></label></section></div>";

	$count = 1;
	foreach($array as $rows) {

		$idh = md5($rows["id"].md5($_SESSION["tsa_gong"]));

		echo '<div class="row">';
		echo "<section class='col col-1'><label class='input'>".$count++."</label></section>";
		echo "<section class='col col-3'><label class='input'>";
		$array = $listcountry->get("WHERE code = '$rows[countrycode]'");
		foreach($array as $rows1) {
			echo $rows1["name"];
		}
		echo '</label></section>';
		echo "<section class='col col-3'><label class='input'>".$rows["name"].'</label></section>';

		echo '<section class="col col-3">';
		if ( utility::check_authentication()) {
               		echo "<a href=\"listregion.php?edit=$idh\" style=\"color: green;\"/>Edit/</a>";
               		echo "<a href=\"listregion.php?delete=$idh\" style=\"color: red;\" 
				onclick=\"return confirm('Are you sure you want to delete $rows[name]? Please make sure you did not assign $rows[name] to any data.');\"/>Delete</a>";
		}
		echo '</section>';
		echo '</div>';
	}
            	echo "<footer><a href=\"listregion.php?add_listregion=yes\"><input type='button' class='button' value='Add region'/></a></footer>";
	echo '</fieldset></form></div>';
}

include("footer.php");
