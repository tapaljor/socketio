<?php

/**
 * Description of class
 *
 * @author tcrc
 */

require_once CLASSES . 'class.inter.php';

class messagearchive extends inter {

    	private $chats = array();
	private $table = 'messagearchive';
	private $sql = false;
	private $status = false;
	private $num_rows = false;

	 /**
	     * 
	     * @return array of the key value paired departments
	     *  Key being the primary key of the department table
	     *  Value being the name of the department
	     * @return boolean false, if no result found
	 */

    	function get($conditions = '') {

		$this->sql = "SELECT DISTINCT * FROM `$this->table` $conditions";
		$this->chats = $this->result($this->sql);//calling parent inter method result which handles rest

		return $this->chats;
    	}
    	function get_custom($fields = '', $conditions = '') {

		$this->sql = "SELECT $fields FROM `$this->table` $conditions";
		$this->chats = $this->result($this->sql);//calling parent inter method result which handles rest

		return $this->chats;
    	}
	function get_num_rows($conditions = '') {

		$this->sql = "SELECT DISTINCT * FROM `$this->table` $conditions";
		$this->num_rows = $this->db->get_num_rows($this->sql);
		return $this->num_rows;
	}

    	function add( $array = array() ) {

		return $this->db->insert($this->table, $array);
    	}
	function update($array = array() ) {

		return $this->db->update($this->table, $array);
	}
	function execute_only($head = '', $conditions = '' ) {

		return $this->db->execute_only($head, $this->table, $conditions);
	}
	function delete($conditions = '') {

		return $this->db->delete($this->table, $conditions);
	}
}
