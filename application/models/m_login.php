<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {
	function login($username, $password){
		$statement = "select * from users where username='$username' and password='$password'";
		// echo $statement;exit;
		$statement= $this->db->query($statement);
		$return = $statement->result_array();
        return $return;
	}
}
?>