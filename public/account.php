<?php include('head.php'); 

require_once CLASSES . 'class.user.php';
require_once CLASSES . 'class.log.php';
require_once CLASSES . 'class.listregion.php';
require_once CLASSES . 'class.listcountry.php';
require_once CLASSES . 'class.likedislike.php';
require_once CLASSES . 'class.listhobby.php';

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
		header("Location: account.php");
	} else {
		echo '<p style="color: #fff;">Error: cannot update</p>';
	}
}
if( isset($_GET["imageedit"]) ) {

	$_GET = $db->clean_array($_GET);

	$id = $user->match_hash($_GET["imageedit"]);

	$array = $user->get("WHERE id = $id");
	foreach($array as $rows) {

		$_SESSION["previousARRAY"] = $rows;
		echo '<div class="body body-s">';
		echo '<form action="account.php" method="POST" class="sky-form" enctype="multipart/form-data">';
			echo '<header>Update image</header>';
			echo '<fieldset>';
			echo "<input type=\"hidden\" name=\"id\" value=\"$rows[id]\"/>";
			echo "<input type=\"hidden\" name=\"idh\" value=\"$_GET[imageedit]\"/>";

			echo '<section class="col col-6">';
				echo '<label class="label"></label>
				<label for="file" class="input input-file">
				<div class="button"><input type="file" name="image" onchange="this.parentNode.nextSibling.value = this.value">Browse for image</div>
				</label>';
			echo '</section>';
			echo '<section class="col col-6">';
			echo '<input type="submit" name="update_image" class="button" value="Update">';
			echo '</section>';
			echo '</fieldset>';
		echo '</form>';
		echo '</div>';
	}
	die();
}

if ( isset($_POST["update"]) && !empty($_POST["update"])) {

	$_POST = $db->clean_array($_POST);

	if( $_POST["password"] !== $_POST["re_password"]) {
		//First password and confirm password should match isn't it?
		 die('<div class="file_error">Password not matching</div>');
	}

	if ( isset($_POST["password"]) && !empty($_POST["password"])) {

		$salt = utility::create_token();
		$_POST["password"] = md5(md5($_POST["password"]).$salt);
		//First it hash plain password THEN added salt on it, then it is hashed again
		$_POST["salt"] = $salt;
	} else {
		unset($_POST["password"]);
	}

	unset($_POST["re_password"]);
	unset($_POST["change_password"]);
	unset($_POST["update"]);

	$status = false;
	$status = $user->update($_POST);
	if ( $status) {
		header("Location: account.php");
	}
}
if( isset($_GET["edit"]) && !empty($_GET["edit"]) ) {

	$id = $user->match_hash($_GET["edit"]);

	$conditions ="WHERE id = $id";
	$array = $user->get($conditions);

	foreach($array as $rows) {
	
		$_SESSION["previousARRAY"] = $rows;
		$idh = md5($rows["id"].$_SESSION["tsa_gong"]);
		?>

		<div class="body body-s">
		<form action="account.php" method="POST" class="sky-form" enctype="multipart/form-data">

			<header><span id="status" style="border: none; margin: 0;">Edit account information</span></header>
			<input type="hidden" name="id" value="<?php echo $rows["id"];?>"/>
			<fieldset>					
			<section>
				<a href="#" onclick="change_pass(); return false;"/>Click here to change password</a>
			</section>
			<section style="display: none;" id="password1">
				<label class="input">
				<input placeholder="Password" type="password" id="password" name="password">
				<b class="tooltip tooltip-bottom-right">First password, better with alphanumeric</b>
				</label>
			</section>
			<section style="display: none;" id="password2">
				<label class="input">
				<input placeholder="Confirm password" type="password" id="re_password" name="re_password" onchange="compare_password(password, re_password);">
				<b class="tooltip tooltip-bottom-right">Please confirm password</b>
				</label>
			</section>
			<section>
				Gender:
				<label class="select">
				<select name="gender">
				<?php 
					if ( $rows["gender"] == 1) {
						echo '<option value="1">Male</p>';
					} 
					else if($rows["gender"] == 2) {
						echo '<option value="2">Female</p>';
					} 
					else if($rows["gender"] == 3) {
						echo '<option value="3">Transgender</p>';
					}
				?>
					<option value="1">Male</option>
					<option value="2">Female</option>
					<option value="3">Transgender</option>
				</select>
				</label>
			</section>
			<section>
				Country:
				<label class="select">
				<select name="country" required onchange="getlistregion(this.value); return false;">
				<?php
				$array1 = $listcountry->get("WHERE code = '$rows[country]'");
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[code]\">$rows1[name]</option>";
				}	
				$array1 = $listcountry->get();
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[code]\">$rows1[name]</option>";
				}		
				?>
				</select>
				</label>
			</section>
			<section id="listregion">
				Region:
				<label class="select">
				<select name="region">
				<?php
				$array1 = $listregion->get("WHERE id = $rows[region]");
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
				}	
				$array1 = $listregion->get();
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
				}		
				?>
				</select>
				</label>
			</section>
			<section>
				Hobby:
				<label class="select">
				<select name="hobby">
				<?php
				$array1 = $listhobby->get("WHERE id = $rows[hobby]");
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
				}	
				$array1 = $listhobby->get();
				foreach($array1 as $rows1) {
					echo "<option value=\"$rows1[id]\">$rows1[name]</option>";
				}		
				?>
				</select>
				</label>
			</section>
			<section>
				Bio data:
				<label class="textarea">
				<textarea name="biodata"><?php echo $rows["biodata"];?></textarea>
				</label>
			</section>
		</fieldset>
		<footer>
			<button type="submit" name="update" class="button"value="Update">Update</button>
		</footer>
		</form>
		</div>
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


