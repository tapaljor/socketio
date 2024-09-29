<?php

class likedislike extends database {

	private $table = 'likedislike';//accessible on in this class, no other classes or PHP outside
	private $sql = false;
	private $status = false;
	private $num_rows = false;

	function get_total_rows($conditions = '') {
		$this->sql = "SELECT id FROM $this->table $conditions";
		return $this->num_rows = $this->get_num_rows_engine($this->sql);
	}
    	function add( $array = array() ) {
		return $this->insert_engine($this->table, $array);
    	}
	function delete($conditions = '') {
		return $this->delete_engine($this->table, $conditions);
	}
}
