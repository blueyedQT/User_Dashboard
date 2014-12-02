<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	public function register_user($user) {
		$query = "INSERT INTO users (first_name, last_name, email, password, user_level, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
		$values = array($user['first_name'], $user['last_name'], $user['email'], $user['password'], 9, date('Y-m-d, H:i:s'), date('Y-m-d, H:i:s'));
		$this->db->query($query, $values);
		return $this->db->insert_id();
	}

	public function login_db($email) {
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
	}
}