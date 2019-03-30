<?php

/**
 * Description of class
 *
 * @author tcrc
 */

require_once CLASSES . 'class.inter.php';

class countryinfo extends inter {

    	private $array = array();
	private $table = 'countryinfo';
	private $sql = false;
	private $status = false;

	 /**
	     * 
	     * @return array of the key value paired departments
	     *  Key being the primary key of the department table
	     *  Value being the name of the department
	     * @return boolean false, if no result found
	 */

    	function get($conditions = '') {

		$this->sql = "SELECT * FROM `$this->table` $conditions";
		$this->array = $this->result($this->sql);//calling parent inter method result which handles rest

		return $this->array;
    	}
}
