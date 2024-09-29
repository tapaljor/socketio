<?php

class country extends database {

    	private $array = array();
	private $table = 'countries';
	private $sql = false;
	private $status = false;

    	function get($fields = '', $conditions = '') {
		$this->sql = "SELECT $fields FROM `$this->table` $conditions";
		$this->array = $this->result($this->sql);//calling parent inter method result which handles rest

		return $this->array;
    	}
    	function add( $_data = array() ) {
		return $this->insert_engine($this->table, $_data);
    	}
	function update( $array = array() ) {
		return $this->db->update_engine($this->table, $array);
	}
	function delete( $conditions = '') {
		return $this->db->delete_engine($this->table, $conditions);
	}
	function match_hash($idh = '') {
		return $this->db->match_hash_engine($this->table, $idh);
	}
}
