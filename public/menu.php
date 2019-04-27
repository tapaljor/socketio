  <a href="" class="logo">
ཕོ་ཉ་
  </a>
  <input class="menu-btn" type="checkbox" id="menu-btn" />
  <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
  <ul class="menu">
	<li><a href="message_archive.php"><span id="new_message" style="color: red;"></span></a></li>
    	<li><a href="find_friends.php">find friends</a></li>
<?php
if ( isset($_SESSION["AdminCHATP"]) && !empty($_SESSION["AdminCHATP"])) {
	echo "<li><a>$_SESSION[AdminCHATP]</a></li>";
	echo "<li><a href=\"welcome.php?logout=$_SESSION[tsa_gong]\">logout</a></li>";
} else {
	header('Location: index.php');
}
?>
  </ul>
