<?php

class database {

	private $con = false;
	private $sql = false;
	private $status = false;
	private $array = array();
	private $id = false;
	private $num_rows = false;

    	function __construct() {
		$this->con = mysqli_connect(LOCALHOST, USERNAME, PASSWORD, DBNAME);
	}
	function result($sql = '') {

		$this->array = array();
		$this->resource = mysqli_query($this->con, $sql);
		while($rows = mysqli_fetch_assoc($this->resource)) {
			$this->array[] = $rows;
		}
		return $this->array;
	}
	function delete_file_engine($table = '', $id = '') {

		$this->sql = "SELECT image FROM `$table` WHERE id = $id";
	        $this->array = $this->result($this->sql);
	
		foreach ($this->array as $rows) {
			print_r($rows);
	            $delete_file = $_SERVER["DOCUMENT_ROOT"] . '/phpchat2/public/uploads/'.$rows["image"];
	            unlink($delete_file);
		}
		return $this->status;
	}
    	function delete_engine($table = '', $id = '') {

        	$this->sql = "DELETE FROM `$table` WHERE id = $id";
		$this->status = $this->query($con, $this->sql);
		if ( $this->status) {
			$this->delete_file($table, $id);
		}
        	return $this->status;
    	}
    	function get_num_rows_engine($sql =  '') {
		
		$this->resource = mysqli_query($this->con, $sql);	
		return $this->num_rows = mysqli_num_rows($this->resource);
    	}
    	function update_engine($table = '', $_data = array() ) {

		$this->sql = $this->create_update_sql($table, $_data);
		return $this->status = mysqli_query($this->con, $this->sql);
    	}
    	function insert_engine($table = '', $_data = array()) {

		$this->sql = $this->create_insert_sql($table, $_data);
		return $this->status = mysqli_query($this->con, $this->sql);
    	}
    	private function create_insert_sql($table = '', $_data = array()) {

        	$_data = $this->clean_array($_data);

        	$this->status = $fields = $values = '';
        	$count = 0;

        	foreach ($_data as $field => $value) {

	                if ($count == 0) {
	                 	$fields .= "`$field`";
	                    	$values .= "'$value'";
	                    	$count++;
	                } else {
	               		$fields .= ", `$field`";
	                	$values .= ", '$value'";
	            	}
        	}
        	$this->sql = "INSERT INTO `$table` ($fields) VALUES ($values)";
        	return $this->sql;
    	}
	private function create_update_sql($table = '', $_data = array()) {

		$this->sql = false;//Resetting private propery $sql to null
		$count = 0;
		foreach($_data as $field => $value) {
			
			if( $field != 'id' && $field != 'idh') {

				if ( $count == 0) {
					$this->sql .= " $field = '$value'";
					$count++;
				} else {
					$this->sql .= ", $field = '$value'";
				}
			}
		}
		$this->sql = "UPDATE `$table` SET $this->sql WHERE id = $_data[id]";
		return $this->sql;
	}
    	function upload_image() {

		$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/phpchat2/public/uploads/';
	        $filename = basename($_FILES['image']['name']);

	        if ($filename != '') {
	
	            $filesize = $_FILES["image"]["size"];
	            $this->check_extension($filename);
	            $this->check_file_size($filesize);

		    /*Checking file type, extension can be anything, but file contents are dangerous */
		    $file_type = getimagesize($_FILES["image"]["tmp_name"]);
		    $this->check_file_type($file_type["mime"]);
                    /* ## end of file type checking */
		
	            $filename = $this->rename_file($filename);
	
	            $uploadfile = $uploaddir . $filename;
	            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
	                return $filename;
	            } else {
	                die('<div id="file_error">Image upload failed</div>');
	            }
	        }
	        return $filename;
    	}
    	function rename_file($filename) {

	        if ($filename != '') {
	            $filename = md5($filename . utility::gettime());
	        }
	        return $filename;
    	}

    	private function check_file_type($file_type) {

        	if (!preg_match("/jpeg|JPEG|jpg|JPG|png|PNG|gif|GIF/", $file_type)) {
			die('<div id="file_error">Apologies, please put proper image file</div>');
		}
    	}
    	private function check_file_size($filesize) {

	        if ($filesize / 1000000 > 1) {
	            die('<div id="file_error">File size exceeded. Please upload photo less than 1MB.</div>');
	        }
    	}
    	private function check_extension($filename) {

        	if (!preg_match("/.(jpeg|JPEG|jpg|JPG|png|PNG|gif|GIF)$/i", $filename)) {
            		die('<div id="file_error">File extension error</div>');
        	}
    	}
    	function clean_array($array) {

	        //As name suggests it cleans every array include POST & GET
	        foreach ($array as $key => $value) {

	        	$cleaned_value = mysqli_real_escape_string($this->con, $value);
		       	$cleaned_value = trim($cleaned_value);
		        $cleaned_value = str_replace(';', '', $cleaned_value);
		        $cleaned_value = str_replace('>', '', $cleaned_value);
		        $cleaned_value = str_replace('<', '', $cleaned_value);
		        $cleaned_value = str_replace('(', '', $cleaned_value);
		        $cleaned_value = str_replace(')', '', $cleaned_value);
		        $cleaned_value = str_replace('=', '', $cleaned_value);
		        $cleaned_value = htmlspecialchars($cleaned_value);//it encodes some codes that are not suppose to enter
		        $array[$key] = $cleaned_value;
	        }
	        return $array;
    	}
	private function get_array_difference($array = array(), $array2 = array()) {
		$diffa = array_diff($array, $array2);
		unset($diffa["enteredby"]);
		unset($diffa["registerdate"]);
		unset($diffa["idh"]);
		return $name  = json_encode($diffa);
	}
	private function get_current_timestamp() {
		$this->nowstamp = strtotime(date('Y-m-d H:i:s'));
		return $this->nowstamp;
	}
	function match_hash_engine($table = '', $hash = '') {

		$this->sql = "SELECT id FROM `$table`";
		$this->array = $this->result($this->sql);
		foreach ($this->array as $rows) {

	            if ($hash === md5($rows["id"].md5($_SESSION["tsa_gong"])) ) {

	            	$this->id = $rows["id"];
			break;
	            }
	        }
		//Checking whether id is numeric or not, as it shouldn't be other than alphnumeric 
		utility::is_numeric($this->id);
	        return $this->id;
	}
	function close_db() {
		mysqli_close($this->con);
	}
}

