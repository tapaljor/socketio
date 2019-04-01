<?php include('head.php'); ?>
<?php	
require_once CLASSES . 'class.likedislike.php';
require_once CLASSES . 'class.log.php';
require_once CLASSES . 'class.listregion.php';
require_once CLASSES . 'class.listcountry.php';
require_once CLASSES . 'class.listhobby.php';
require_once CLASSES . 'class.user.php';

$user = new user();
$likedislike = new likedislike();
$log = new log();
$listregion = new listregion();
$listcountry = new listcountry();
$listhobby = new listhobby();
?>
<style>
a, p, b {
	margin: 0;
	font-family: 'Open Sans', sans-serif; 
	font-weight: normal;
	text-decoration: none;
}
#particular_one {
	width: 700px;
	margin: auto;
}
.picture {
	width: 150px;
	height: 150px;
	position: relative;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	cursor: pointer;
}
.picture img {
	width: 130px;
	height: 130px;
	border-radius: 50%;
}
.picture .circle {
	position: absolute;
	border-radius: 50%;
	border: 1px solid;
	transition: all 1.6s ease-in;
}
.picture .circle2 {
	width: 140px;
	height: 140px;
	border-color: #ddd transparent #333 #aaa;
}
.picture:hover .circle2 {
	transform: rotate(-360deg);
}
.name {
	width: 100%;
	clear: both;
	text-align: center;
}
.btn {
	border: 1px solid #786450;
	border-radius: 20px;
	padding: 7px 30px;
	font-size: 13px;
	margin: 1em auto;
}
.btn:hover {
	background-color: #786450;
	color: white;
}
.name b {
	font-weight: bold;
	font-size: 1.2em;
	text-transform: uppercase;
}
.likedislike {
	padding: .5em;
	margin: .5em;
}
.likedislike span {
	font-family: times new roman, sans-serif;
}
@media screen and (max-width: 782px) {
	#particular_one, .stats {
		width: 100%;
		clear: both;
	}
}
</style>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,600" rel="stylesheet">
<?php
echo '<div id="particular_one">';
if( isset($_GET["idh"]) && !empty($_GET["idh"])) {

	$id = $user->match_hash($_GET["idh"]);
	$array = $user->get('*', "WHERE id = $id");
	foreach($array as $rows) {

	?>
	<div class="picture">
		<?php
		if ( !empty($rows["image"])) {
			echo "<img src=\"uploads/$rows[image]\">";
		} else {
			if( $rows["gender"] == 1) { 
				echo '<img src="images/male.jpeg"/>';
			} else {
				echo '<img src="images/female.jpeg"/>';
			}
		}?>
		<div class="circle circle2"></div>
	</div>
	<div class="name">
		<?php echo "<p><a href=\"account.php?imageedit=$_GET[idh]\">Change photo</a></p>";?>
		<p><b><?php echo $rows["username"];?></b></p>
		<p><?php
		$array1 = $listhobby->get('*', "WHERE id = $rows[hobby]");
		foreach($array1 as $rows1) { 
			echo '<i>'.$rows1["name"].'</i><br/>';
		}
		$array1 = $listregion->get('*', "WHERE id = $rows[region]");
		foreach($array1 as $rows1) {
			echo $rows1["name"].', ';
		}
		$array1 = $listcountry->get('*', "WHERE code = '$rows[country]'");
		foreach($array1 as $rows1) {
			echo $rows1["name"].'<br/>';
		}
		if ( $rows["gender"] == 1) {
			echo 'Male';
		} else {
			echo 'Female';
		}	
?>
		</p>
		<button class="btn">
		<?php echo "<a href=\"home.php?destinationh=$_GET[idh]\">Start chat</a>";?>
		</button>
		<p>
<?php
		$like = $dislike = false;
		$likes = $dislikes = false;
		$conditions = "WHERE loginid = $rows[id] && type = 1";
		$likes = $likedislike->get_total_rows($conditions);

		$conditions = "WHERE loginid = $rows[id] && type = 0";
		$dislikes = $likedislike->get_total_rows($conditions);

		if ( $rows["status"] == 2) {
			echo "<p style='color: green; font-size: 1em;' title=\"$rows[username] is online\">Online</p>";
		} else {
			echo "<p style='color: red; font-size: 1em;' title=\"$rows[username] is not active for now\">Offline</p>";
		}
		echo '<div class="likedislike">';
		echo "<a href='#' onclick=\"likedislike('$_GET[idh]', '$_SESSION[idhashCHATP]', 1); return false\">";
		echo "<span style='color: green;'>$likes likes, </span>";
		echo '</a>';
		echo "<a href='#' onclick=\"likedislike('$_GET[idh]', '$_SESSION[idhashCHATP]', 0); return false\">";
		echo "<span style='color: red;'>$dislikes dislikes</span>";
		echo '</a>';
		echo '</div>';

		if ( $_GET["idh"] === $_SESSION["idhashCHATP"]) {
			echo "<p><a href=\"account.php?edit=$_GET[idh]\"><button class='btn'>Edit profile</div></a></p>";
		}
?>
	</div>
<?php
	}
}
echo '</div>';
include('footer.php');


