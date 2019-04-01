<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<!--- Without this it will assume mobile browser as full screen -->
	<link rel="stylesheet" href="css/login.css"/>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="js/custom.js"></script>
</head>
<?php
session_start();

header("Cache-control: max-age: 1000");

require_once('config.php');
require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.utility.php';
require_once CLASSES . 'class.listcountry.php';
require_once CLASSES . 'class.listregion.php';
require_once CLASSES . 'class.listhobby.php';
require_once CLASSES . 'class.user.php';

$db = new database();
$listcountry = new listcountry();
$listregion = new listregion();
$listhobby = new listhobby();
$user = new user();

if ( isset($_GET["add"]) && !empty($_GET["add"])) {
?>
	<form action="upload.php" method="POST">

		<h1>REGISTER</h1>

		<input type='hidden' name='registerdate' value="<?php echo $nowstamp; ?>"/>
		<input type="hidden" name="salt" value="<?php echo utility::create_token(); ?>"/>
		<input type="text" placeholder="Nickname*" name="username" required="required" onchange="check_username(this.value)">
		<div class="validate_username"></div>
		<input placeholder="Password*" type="password" name="password" required="required">
		<input placeholder="Confirm password*" type="password" required="required" name="re_password" onchange="compare_password(password, re_password);">
		<div class="validate_password"></div>
		<select name="gender" required>
			<option value="">Select gender*</option>
			<option value="1">Male</option>
			<option value="2">Female</option>
			<option value="3">Others</option>
		</select>
		<select name="country" required onchange="getlistregion(this.value); return false;">
			<option value="">Select your country*</option>
			<?php
			$array1 = $listcountry->get('*', '');
			foreach($array1 as $rows1) {
				echo "<option value=\"$rows1[code]\">$rows1[name]</option>";
			}		
		?>
		</select>
		<div id="listregion"></div> 
		<select name="hobby" required>
			<option value="">Select hobby*</option>
		<?php
			$array1 = $listhobby->get('*', '');
			foreach($array1 as $rows1) {
				echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
			}		
		?>
		</select>
		<img src="myimage.php" width="130em;"/>
		<input type="text" name="captcha" required="required" placeholder="Enter code above"/>
		<button type="submit" name="register" class="button" value="register">Create account</button>
	</form>
<?php
}

if ( isset($_POST["register"])  && !empty($_POST["register"]) ) {

	$_POST = $db->clean_array($_POST);

	if($_POST["captcha"] !== $_SESSION["validation_code"]) {
		die('<div id="file_error">Captcha failure</div>');
	}
	utility::is_username($_POST["username"]);

	$users = $user->get_num_rows("WHERE username = '$_POST[username]'");
	if ( $users > 0 ) {
		 die('<div id="file_error">Username is already there</div>');
	}
	
	if( $_POST["password"] != $_POST["re_password"]) {
		 die('<div id="file_error">Password not matching</div>');
	}
	$_POST["password"] = md5(md5($_POST["password"]).$_POST["salt"]);

	//Fields that are not required for database
	unset($_POST["save"]);
	unset($_POST["tokenh"]);
	unset($_POST["re_password"]);
	unset($_POST["captcha"]);
	unset($_POST["checkbox"]);
	unset($_POST["register"]);

	$_POST["status"] = 2;
	$status = $user->add($_POST);

	if ( $status ) { 

		$conditions = "WHERE username = '$_POST[username]'";
		$array = $user->get('id, username', $conditions);
		foreach ( $array as $rows) {
			$_SESSION["tsa_gong"] = utility::create_token();
			$_SESSION["AdminCHATP"] = $rows["username"];
			$_SESSION["idCHATP"] = $rows["id"];
			$_SESSION["idhashCHATP"] = md5($rows["id"].md5($_SESSION["tsa_gong"]));
		}
		header('location: findfriends.php');
	} else {
		echo '<div id="file_error">Registration failed</div>';
	}
}
