<?php

class chat extends database {

    	private $array = array();
	private $table = 'chat';//accessible on in this class, no other classes or PHP outside
	private $sql = false;
	private $status = false;
	private $num_rows = false;

	function execute($conditions = '') {
		$this->sql = "UPDATE `$this->table` SET $conditions";
		return $this->status = $this->execute_engine($this->sql);
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
