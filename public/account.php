<head>
	<link rel="stylesheet" href="css/login.css"/>
</head>
<?php include('head.php'); 

require_once CLASSES . 'class.db.php';
require_once CLASSES . 'class.user.php';
require_once CLASSES . 'class.log.php';
require_once CLASSES . 'class.listregion.php';
require_once CLASSES . 'class.listcountry.php';
require_once CLASSES . 'class.likedislike.php';
require_once CLASSES . 'class.listhobby.php';

$db = new database();
$user = new user();
$listregion = new listregion();
$listcountry = new listcountry();
$likedislike = new likedislike();
$listhobby = new listhobby();

if ( isset($_POST["update_image"])) {

	$_POST = $db->clean_array($_POST);

	//DEALING with IMAGE of a person
	$filename = false;
	if ( isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {

		$user->delete_file($_POST["id"]);//Deleting existing image to be replaced by new one just below this line
		$filename = $db->upload_image();
	} 
	if ( empty($filename)) {
		$filename = $_POST["image2"];
	}
	$_POST["image"] = $filename;
	unset($_POST["image2"]);
	unset($_POST["update_image"]);

	$status = false;
	$status = $user->update($_POST);

	if($status) {
		header("Location: particular_one.php?idh=$_POST[idh]");
	} else {
		echo '<p style="color: #fff;">Error: cannot update</p>';
	}
}
if( isset($_GET["imageedit"]) ) {

	$_GET = $db->clean_array($_GET);

	$id = $user->match_hash($_GET["imageedit"]);
	$array = $user->get('id, image', "WHERE id = $id");
	foreach($array as $rows) {

		echo '<form action="account.php" method="POST" enctype="multipart/form-data" style="width: 40%;">';
			echo "<input type=\"hidden\" name=\"id\" value=\"$rows[id]\"/>";
			echo "<input type=\"hidden\" name=\"image2\" value=\"$rows[image]\"/>";
			echo "<input type=\"hidden\" name=\"idh\" value=\"$_GET[imageedit]\"/>";
			echo '<input type="file" name="image" id="file" class="inputfile" />';
			echo '<label for="file">Upload an image</label><br/>';
			echo '<button type="submit" name="update_image" class="btn">Update</button>';
		echo '</form>';
	}
	die();
}
if ( isset($_POST["update"]) && !empty($_POST["update"])) {

	$_POST = $db->clean_array($_POST);

	$idh = $_POST["idh"];
	if ( isset($_POST["re_password"]) && !empty($_POST["re_password"])) {
		$_POST["salt"] = utility::create_token();
		$_POST["password"] = md5(md5($_POST["password"]).$_POST["salt"]);
	} else { 
		unset($_POST["password"]);
	}
	unset($_POST["re_password"]);
	unset($_POST["change_password"]);
	unset($_POST["idh"]);
	unset($_POST["update"]);

	$status = false;
	$status = $user->update($_POST);
	if ( $status) {
		header("Location: particular_one.php?idh=$idh");
	}
}
if( isset($_GET["edit"]) && !empty($_GET["edit"]) ) {

	$id = $user->match_hash($_GET["edit"]);

	if ( $_GET["edit"] !== $_SESSION["idhashCHATP"]) {
		die('Cannot find one');
	}	
	$conditions ="WHERE id = $id";
	$array = $user->get('id, username, gender, country, region, hobby', $conditions);

	foreach($array as $rows) {
	?>
		<form action="account.php" method="POST">

			<input type="hidden" name="id" value="<?php echo $rows["id"];?>"/>
			<input type="hidden" name="idh" value="<?php echo $_GET["edit"];?>"/>
			<a href="#" onclick="change_pass(); return false;"/>Change password</a>
			<input type="text" name="username" value="<?php echo $rows["username"];?>" onchange="check_username(this.value)">
			<div class="validate_username"></div>
			<div style="display: none;" id="password1">
				<input placeholder="Password" type="password" name="password">
				<input placeholder="Confirm password" type="password" name="re_password" onchange="compare_password(password, re_password);">
			</div>
			<div class="validate_password"></div>
			Gender:
			<select name="gender">
			<?php 
				if ( $rows["gender"] == 1) {
					echo '<option value="1">Male</p>';
				} 
				else if($rows["gender"] == 2) {
					echo '<option value="2">Female</p>';
				} 
				else if($rows["gender"] == 3) {
					echo '<option value="3">Other</p>';
				}
			?>
				<option value="1">Male</option>
				<option value="2">Female</option>
				<option value="3">Other</option>
			</select>
			Country:
			<select name="country" required onchange="getlistregion(this.value); return false;">
			<?php
				$array1 = $listcountry->get('*', "WHERE code = '$rows[country]'");
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[code]\">$rows1[name]</option>";
				}	
				$array1 = $listcountry->get('*', '');
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[code]\">$rows1[name]</option>";
				}		
				?>
			</select>
			Region:
			<div id="listregion">
			<select name="region">
				Region:
				<?php
				$array1 = $listregion->get('*', "WHERE id = $rows[region]");
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
				}	
				$array1 = $listregion->get('*', '');
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
				}		
				?>
			</select>
			</div>
			Hobby:
			<select name="hobby">
				<?php
				$array1 = $listhobby->get('*', "WHERE id = $rows[hobby]");
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
				}	
				$array1 = $listhobby->get('*', '');
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
				}		
				?>
			</select>
			<button type="submit" name="update" class="btn" value='update'>Update</button>
		</form>
	<?php
	}
	die();
} 
if( isset($_SESSION["idCHATP"]) && !empty($_SESSION["idCHATP"])) {

	$conditions ="WHERE id = $_SESSION[idCHATP]";

	$array = $user->get($conditions);
	foreach($array as $rows) {

		$idh = md5($rows["id"].md5($_SESSION["tsa_gong"]));
		?>
		<?php
		echo '<div class="container3">';
			if ( !empty($rows["image"])) {
				echo "<a href=\"upload/$rows[image]\"><img src=\"upload/$rows[image]\"></a>";
			}
			else if( $rows["gender"] == 1) { 
				echo '<img src="images/male.jpeg"/>';
			} else {
					echo '<img src="images/female.jpeg"/>';
			}	
		echo '</div>';	
		echo '<p style="text-align: center; font-size: 1.2em; font-weight: bold;">'.$rows["username"].'</p>';
		echo '<p style="text-align: center;">';
		if ( $rows["gender"] == 1) {
			echo 'Male';
		} 
		else if($rows["gender"] == 2) {
			echo 'Female';
		}
		else if ( $rows["gender"] == 3) {
			echo 'Transgender';
		}
		echo '</p>';
		echo '<p style="text-align: center;">';
		$listregions = $listregion->get("WHERE id = $rows[region]");
		foreach($listregions as $rows1) {
			echo $rows1["name"];
			$countrycode = $rows1["countrycode"];
		}
		$array1 = $listcountry->get("WHERE code = '$countrycode'");
		foreach($array1 as $rows1) {
			echo ', '.$rows1["name"];
		}
		echo '</p>';
		echo '<p style="text-align: center;">';
			$array1 = $listhobby->get("WHERE id = $rows[hobby]");
			foreach($array1 as $rows1) {
				echo $rows1["name"];
			}
		echo '</p>';
		echo '<p style="text-align: center; font-weight: bold;">';
			echo str_replace("\\", "<br/>", $rows["biodata"]);
		echo '</p>';
		echo '<div id="likedislike">';
			$like = $dislike = false;
			$likes = $dislikes = false;
			$conditions = "WHERE loginid = $rows[id] && type = 1";
			$likes = $likedislike->get_total_rows($conditions);
	
			$conditions = "WHERE loginid = $rows[id] && type = 0";
			$dislikes = $likedislike->get_total_rows($conditions);

			//Parameter passed for ajax like dislike loginid, likerid and 0, 1 like and dislike respectively
			echo "<a href='#' title='Like' onclick=\"likedislike('$idh', '$_SESSION[idhashCHATP]', 1); return false\" style='font-size: 2em;'>&#128077; <span style='font-size: 14px;'>$likes &nbsp;</span></a> ";
			echo "<a href='#' title='Dislike' onclick=\"likedislike('$idh', '$_SESSION[idhashCHATP]', 0); return false\" style='font-size: 2em; color: red;'>&#128078; <span style='font-size: 14px; color: red;'> $dislikes</span></a> ";
		echo '</div>';
		echo "<br/><a style='text-align: center;' href=\"account.php?imageedit=$idh\">Change picture</a>";
		if ( $rows["username"] === $_SESSION["AdminCHATP"]) {
			echo "<p style='text-align: center;' href=\"account.php?edit=$idh\" title='Edit account' style='color: green; font-size: 3em;'>&#9998;</p>";
		}
	}
} 
include('footer.php');


