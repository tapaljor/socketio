<?php

class listhobby extends database {

    	private $array = array();
	private $table = 'listhobby';
	private $sql = false;
	private $status = false;
	private $rows = false;

    	function get($fields = '', $conditions = '') {
		$this->sql = "SELECT $fields FROM `$this->table` $conditions";
		$this->array = $this->result($this->sql);//calling parent inter method result which handles rest
		return $this->array;
    	}
    	function add( $_data = array() ) {
		return $this->insert($this->table, $_data);
    	}
	function update( $array = array() ) {
		return $this->update_engine($this->table, $array);
	}
	function delete( $conditions = '') {
		return $this->delete_engine($this->table, $conditions);
	}
	function load_more_query($from = '') {
		$this->sql = "SELECT * FROM `$this->table` ORDER BY id DESC LIMIT $from, 5";
		$this->array = $this->result($this->sql);
		return $this->array;
	}
	function match_hash($idh = '') {
		return $this->match_hash($this->table, $idh);
	}
}
