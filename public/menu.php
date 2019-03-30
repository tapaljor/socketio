  <a href="" class="logo">
    <img src="https://i.ibb.co/w6fMJd0/hat.png"/>
  </a>
  <input class="menu-btn" type="checkbox" id="menu-btn" />
  <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
  <ul class="menu">
<?php
if ( isset($_SESSION["AdminCHATP"]) && !empty($_SESSION["AdminCHATP"])) {
	echo '<li><a href="home.php">'.$_SESSION["AdminCHATP"].'<li>';
	echo "<li><a href=\"home.php?logout=343defeffhiw\">logout</a></li>";
} else {
	header('Location: index.php');
}
?>
    <li><a href="findfriends.php">find friends</a></li>
  </ul>
