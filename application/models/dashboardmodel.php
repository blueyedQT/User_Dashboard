<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	// public function __construct(){
	// 	parent::__construct();
	// 	var_dump($this->session->all_userdata());
	// }

	public function register_user($user) {
		$query = "INSERT INTO users (first_name, last_name, email, password, user_level, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
		$values = array($user['first_name'], $user['last_name'], $user['email'], $user['password'], 9, date('Y-m-d, H:i:s'), date('Y-m-d, H:i:s'));
		$this->db->query($query, $values);
		return $this->db->insert_id();
	}
}