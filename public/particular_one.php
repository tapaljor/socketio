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
a, p {
	margin: 0;
	font-family: 'Open Sans', sans-serif; 
	font-weight: normal;
	text-decoration: none;
}
.frame {
	width: 400px;
	height: 400px;
margin: auto;
	color: #fff;
	display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-family: 'Open Sans', sans-serif;
    letter-spacing: .5px;
    line-height: 1;
    color: white;
}
.profile {
	width: 320px;
	height: 300px;
	background-color: white;
	border-radius: 3px;
	box-shadow: 9px 9px 20px #0000005c;
	overflow: hidden;
	display: flex;
	color: #786450;
}
.user {
	flex: 1;
	display: flex;
	flex-direction: column;
}
.actions {
	width: 80%;
	clear: both;
	flex: 0 0 120px;
	display: flex;
	flex-direction: column;
	justify-content: space-evenly;
	align-items: initial;
padding: 0px 30px;
}
.details {
	flex: 1;
	display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.picture {
	width: 120px;
	height: 120px;
	position: relative;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	cursor: pointer;
}
.picture img {
	width: 70px;
	height: 70px;
	border-radius: 50%;
}
.picture .circle {
	position: absolute;
	border-radius: 50%;
	border: 1px solid;
	transition: all 1.6s ease-in;
}
.picture .circle1 {
	width: 76px;
	height: 76px;
	border-color: #786450 #786450 #786450 transparent;
}
.picture .circle2 {
	width: 82px;
	height: 82px;
	border-color: #786450 transparent #786450 #786450;
}
.picture:hover .circle1 {
	transform: rotate(360deg);
}
.picture:hover .circle2 {
	transform: rotate(-360deg);
}
.name {
	display: flex;
	align-items: center;
	justify-content:  center;
	flex-direction: column;
}
.name-text {
	font-size: 13px;
	margin-bottom: 3px;
	text-transform: uppercase;
}
.stats {
	flex: 0 0 120px;
	background: #F5E8DF;
	display: flex;
	flex-direction: column;
}
.stat {
	display: flex;
	align-items: center;
	justify-content:  center;
	width: 100%;
	height: 100px;
	flex-direction: column;
	border: 2px solid #fff;
	background-color: transparent;
	transition: all .4s ease;
	cursor: pointer;
}
.stat:last-of-type {
	border-bottom: none;
}
.stat:hover {
	background-color: rgba(191, 123, 76, 0.23);
}
.big-text {
	font-weight: bold;
	font-size: 12px;
	text-align: center;
}
.btn {
	background-color: transparent;
	border: 1px solid #786450;
	border-radius: 20px;
	padding: 7px 30px;
	font-size: 13px;
	font-weight: 500;
}
.btn:hover {
	background-color: #786450;
	color: white;
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
	<div class="frame">
		<div class="profile">
			<div class="user">
				<div class="details">
					<div class="picture">

						<?php
						if( $rows["gender"] == 1) { 
							echo '<img src="images/male.jpeg"/>';
						} else {
							echo '<img src="images/female.jpeg"/>';
						}?>
						<div class="circle circle1"></div>
						<div class="circle circle2"></div>
					</div>
					<div class="name">
					<b class="name-text"><?php echo $rows["username"];?></b>
						<p style="text-align: center;"><?php
						$array1 = $listhobby->get('*', "WHERE id = $rows[hobby]");
						foreach($array1 as $rows1) { 
							echo $rows1["name"].'<br/>';
						}
						$array1 = $listregion->get('*', "WHERE id = $rows[region]");
						foreach($array1 as $rows1) {
							echo $rows1["name"].', ';
						}
						$array1 = $listcountry->get('*', "WHERE code = '$rows[country]'");
						foreach($array1 as $rows1) {
							echo $rows1["name"].'<br/>';
						}
						?>
						</p>
					</div>
				</div>
				<div class="actions">
					<button class="btn">
				<?php
					if ( $rows["gender"] == 1) {
						echo 'Male';
					} else {
						echo 'Female';
					}
				?>
					</button>
					<button class="btn">
						<?php echo "<a href=\"home.php?destinationh=$_GET[idh]\">Start chat</a>";?>
					</button>
				</div>
			</div>
			<div class="stats">
				<div class="stat follow">
					<span class="big-text">
				<?php
				if ( $rows["status"] == 2) {
					echo "<a style='color: green; font-size: 1em;' title=\"$rows[username] is online\" href=\"home.php?destinationh=$_GET[idh]\">Online</a>";
				} else {
					echo "<a style='color: red; font-size: 1em;' title=\"$rows[username] is not active for now\">Offline</a>";
				}
				?>
					</span>
				</div>
<?php
				$like = $dislike = false;

				$likes = $dislikes = false;
				$conditions = "WHERE loginid = $rows[id] && type = 1";
				$likes = $likedislike->get_total_rows($conditions);

				$conditions = "WHERE loginid = $rows[id] && type = 0";
				$dislikes = $likedislike->get_total_rows($conditions);
?>
				<?php 
				echo "<a href='#' onclick=\"likedislike('$_GET[idh]', '$_SESSION[idhashCHATP]', 1); return false\">";
				echo '<div class="stat like">';
				echo '<span class="big-text">';
				echo "$likes <br/>LIKES";
				echo '</span>';
				echo '</div>';
				echo '</a>';

				echo "<a href='#' onclick=\"likedislike('$_GET[idh]', '$_SESSION[idhashCHATP]', 0); return false\">";
				echo '<div class="stat like">';
				echo '<span class="big-text">'; 
				echo "$dislikes <br/>DISLIKES";
				echo '</span>';
				echo '</div>';
				echo '</a>';
?>
			</div>
		</div>
	</div>
<?php
	}
}
echo '</div>';
include('footer.php');


