<?php

class log {

    	private $array = array();
	private $table = 'log';//accessible on in this class, no other classes or PHP outside
	private $sql = false;
	private $status = false;
	private $num_rows = false;

    	function get($conditions = '') {

		$this->sql = "SELECT *, $this->table.id FROM `$this->table` $conditions";
		$this->array= $this->result($this->sql);//calling parent inter method result which handles rest

		return $this->array;
    	}
    	function get_users_username($conditions = '') {

		$this->sql = "SELECT username FROM `$this->table` $conditions";
		$this->users = $this->result($this->sql);//calling parent inter method result which handles rest

		return $this->users;
    	}
	function get_num_rows($conditions = '') {

		$this->sql = "SELECT * FROM $this->table $conditions";
		$this->num_rows = $this->db->get_num_rows($this->sql);
		return $this->num_rows;
	}
    	function add( $array = array() ) {

		return $this->db->insert($this->table, $array);
    	}
	function update($array = array() ) {

		return $this->db->update($this->table, $array);
	}
	function match_hash($hash = '') {

		return $this->db->match_hash($this->table, $hash);
	}
}
