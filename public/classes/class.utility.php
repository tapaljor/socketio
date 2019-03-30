<?php
@session_start();
class utility {

	static function pr($a) {
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}
	static function is_numeric($id) {

		if( !is_numeric($id)) {
			die('<div id="file_error">Not a numeric value</div>');
		}
	}
	static function is_alphanumeric( $text = '' ) {

		if ( !preg_match('/^[a-zA-Z0-9]+$/', $text ) ) {
			die('<p id="status">Only alpha numerics are allowed</p>');
		}
	}
	static function is_username( $text = '' ) {

		$status = true;
		if(!preg_match('/^[a-zA-Z0-9]+$/',$text) ) {
			$status = false;
		}
		if ( !$status) {
			die('<div id="file_error">Username cannot contain special characters or spaces</div>');
		}	
	}
	static function check_authentication() {

		$status = false;
		if( isset($_SESSION["AdminCHATP"]) && !empty($_SESSION["AdminCHATP"]) ) {
			$status = true;
		}
		return $status;
	}
	static function create_token() {

		for ($i = -1; $i <= 16; $i++) {
			$bytes = openssl_random_pseudo_bytes($i, $cstrong);
		       	$random_no = bin2hex($bytes);
		}
		return $random_no;
	}
	static function check_captcha($validation_code_from_user = '') {

		if($validation_code_from_user !== $_SESSION["validation_code"]) {
			die('<div id="file_error">Captcha failure</div>');
		}
	}
	static function get_qr($valued) {
		echo "<img src=qr_code/php/qr_img.php?d=$valued/>";
	}
	static function validate_email($email) {

		$status = true;
		if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
			$status = false;
		}
		return $status;
	}
	static function member( $array = array() ) {

		require_once 'config.php';
		require_once CLASSES . 'class.db.php';
		require_once CLASSES . 'class.likedislike.php';
		require_once CLASSES . 'class.listregion.php';
		require_once CLASSES . 'class.listhobby.php';

		$db = new database();
		$likedislike = new likedislike();
		$listregion = new listregion();
		$listhobby = new listhobby();
		
		$count = 0;
		echo '<table>';
		foreach ( $array as $rows) {

			$idh = md5($rows["id"].md5($_SESSION["tsa_gong"]));
	
				echo '<tr><td class="container4">';
				if ( empty($rows["image"]) ) {
					echo "<a href=\"particular_one.php?idh=$idh\" title='Click here for detail'>";
					if( $rows["gender"] == 1) { 
						echo '<img src="images/male.jpeg"/>';
					} else {
						echo '<img src="images/female.jpeg"/>';
					}	
					echo '</a>';
				} else {
					echo "<a href=\"particular_one.php?idh=$idh\"><img src=\"upload/$rows[image]\" title='Click here for detail'/></a>";
				}
				echo '</td>';
					$array1 = $listhobby->get('name', "WHERE id = $rows[hobby]");
					foreach($array1 as $rows1) {
						$hobby = $rows1["name"];
					}
				echo "<td><a href=\"particular_one.php?idh=$idh\">".$rows["username"].'<br/><i>'.$hobby.'</i></a></td>';
				echo '<td>';
					if ( $rows["gender"] == 1) {
						echo '<i>Male </i>';
					} else {
						echo '<i>Female </i>';
					}
				echo '</td>';
				echo '<td>';
					if ( $rows["status"] == 2) {
						echo '<span style="color: green;"> (Online)</span>';
					} else {
						echo '<span style="color: red;"> (Offline)</span>';
					}
				echo '</td>';
				echo '<td>';
					$array1 = $listregion->get('name, countrycode', "WHERE id = $rows[region]");
					foreach($array1 as $rows1) {
						echo $rows1["name"].'<br/>';
						echo $rows1["countrycode"];
					}
				echo '</td>';
				echo '<td>';
					echo "<a href=\"home.php?destinationh=$idh\" class='btn'>Start chat</a>";
				echo '</td>';
			$count++;
		}
		echo '</table>';
	}
	static function time_ago($time) {
	
		$etime = time() - $time;
	
		if ($etime < 1) {
			return '0 seconds';
		}
		
		$a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
			30 * 24 * 60 * 60           =>  'month',
			24 * 60 * 60                =>  'day',
			60 * 60                     =>  'hour',
			60                          =>  'min',
			1        	            =>  'sec' 
			);
		
		foreach ($a as $secs => $str) {
			$d = $etime / $secs;
			
			if ($d >= 1) {
				$r = round($d);
				return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
			}
		}
	}
	static function clean_dirty_words($message) {

		//bad words array which is used to hide/remove if somebody types
		$words = "shit, piss, fuck, cunt, cock, fuk, sucker, mother, fucker, tits, turd, twat, nigger, nigro, beaner, spic, gooback, sandmonkey, homo, ligpa, likpa, kyakpa, kyagpa";

		$badwords = array();
		$badwords = explode(",", $words);
		$message = explode(" ", $message);

		foreach($message as $key=>$word) {

			foreach($badwords as $bad) {

				if ( trim(strtolower($bad)) === trim(strtolower($word))) {
					$word = '!@#$';
					break;
				} 
			}
			$array["$key"] = $word;
		}
		return $array;
	}
	static function gettime() {

		$now = date('Y-m-d H:i:s');
		return $nowstamp = strtotime($now);
	}
}
