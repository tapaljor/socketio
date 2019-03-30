<?php
session_start();
require_once('config.php');
require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.utility.php';
require_once CLASSES . 'class.listregion.php';

$db = new database();
$listregion = new listregion();

echo '<label class="select">';
echo '<select name="region">';
$array1 = $listregion->get('*', "WHERE countrycode = '$_POST[code]'");
foreach($array1 as $rows1) {
	echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
}
if ( empty($array1)) {
	echo "<option value=\"0\">NA</option>";
}
echo '</select>';
echo '</label>';

