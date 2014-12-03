<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	public function register_user($user) {
		$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?,?,?)";
		$values = array($user['first_name'], $user['last_name'], $user['email'], $user['password'], date('Y-m-d, H:i:s'), date('Y-m-d, H:i:s'));
		$this->db->query($query, $values);
		return $this->db->insert_id();
	}

	public function login_db($email) {
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
	}

	public function get_all_users() {
		$query = "SELECT users.id, CONCAT_WS(' ', first_name, last_name) AS user_name, 
					email, DATE_FORMAT(created_at, '%M %D %Y') AS created, user_levels.name AS level
					FROM users
					LEFT JOIN user_levels 
					ON users.user_level = user_levels.id
					ORDER BY users.id DESC";
		return $this->db->query($query)->result_array();
	}

	public function get_user($id) {
		return $this->db->query("SELECT * FROM users WHERE id = ?", $id)->row_array();
	}

	public function get_admin_levels() {
		return $this->db->query("SELECT * FROM user_levels")->result_array();
	}

	public function update_user($user) {
		$query = "UPDATE users SET email=?, first_name=?, last_name=?, user_level=?, updated_by=?, updated_at=? WHERE id = ?";
		$values = array($user['email'], $user['first_name'], $user['last_name'], $user['user_level'], $user['updated_by'], date('Y-m-d, H:i:s'), $user['id']);
		$this->db->query($query, $values);
		return $this->db->affected_rows();
	} 
}