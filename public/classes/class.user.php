<?php

class user extends database {

    	private $array = array();
	private $table = 'login';//accessible on in this class, no other classes or PHP outside
	private $sql = false;
	private $status = false;
	private $num_rows = false;

	function check_login($username = '', $password = '') {

		$this->sql = "SELECT id, username, password, salt FROM `$this->table` WHERE username = '$username'";
		$this->array = $this->result($this->sql);

		foreach($this->array as $rows) {

			if ( $username === $rows["username"] && $rows["password"] === md5(md5($password).$rows["salt"])) {

				$_SESSION["AdminCHATP"] = $username;
				$_SESSION["idCHATP"] = $rows["id"];
				$_SESSION["idhashCHATP"] = md5($rows["id"].md5($_SESSION["tsa_gong"]));
				$this->status = true;
			} 
		}
		return $this->status;
	}
	function get($fields, $conditions = '') {
		$this->sql = "SELECT $fields FROM `$this->table` $conditions";
		$this->array = $this->result($this->sql);
		return $this->array;
	}
	function delete_file($id = '') {
		return $this->delete_file_engine($this->table, $id);
	}
	function delete() {
		return $this->status = $this->delete_engine($this->table, $_SESSION["idCHATP"]);
	}
    	function get_users_username($conditions = '') {
		$this->sql = "SELECT username FROM `$this->table` $conditions";
		$this->users = $this->result($this->sql);

		return $this->users;
    	}
	function get_num_rows($conditions = '') {
		$this->sql = "SELECT * FROM `$this->table` $conditions";
		return $this->num_rows = $this->get_num_rows_engine($this->sql);
	}
    	function add( $array = array() ) {
		return $this->insert_engine($this->table, $array);
    	}
	function update($array = array() ) {
		return $this->update_engine($this->table, $array);
	}
	function match_hash($hash = '') {
		return $this->match_hash_engine($this->table, $hash);
	}
}
