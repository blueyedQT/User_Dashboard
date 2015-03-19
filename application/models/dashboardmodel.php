<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	public function check_email($email) {
		$query = "SELECT * FROM users WHERE email = ?";
		$values = array($email); 
		return $this->db->query($query, $values)->row_array();
	}

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
		$query = "SELECT id, first_name, last_name, DATE_FORMAT(created_at, '%M %D, %Y') AS created, email, description, user_level 
				  FROM users WHERE id = ?";
		$value = $id;
		return $this->db->query($query, $value)->row_array();
	}

	public function get_admin_levels() {
		return $this->db->query("SELECT * FROM user_levels")->result_array();
	}

	public function admin_update_user($user) {
		$query = "UPDATE users SET email=?, first_name=?, last_name=?, user_level=?, updated_by=?, updated_at=? WHERE id = ?";
		$values = array($user['email'], $user['first_name'], $user['last_name'], $user['user_level'], $user['updated_by'], date('Y-m-d, H:i:s'), $user['id']);
		$this->db->query($query, $values);
		return $this->db->affected_rows();
	}

	public function update_user($user) {
		$query = "UPDATE users SET email=?, first_name=?, last_name=?, updated_by=?, updated_at=? WHERE id = ?";
		$values = array($user['email'], $user['first_name'], $user['last_name'], $user['updated_by'], date('Y-m-d, H:i:s'), $user['id']);
		$this->db->query($query, $values);
		return $this->db->affected_rows();
	}

	public function update_password($data) {
		$query = "UPDATE users SET password=?, updated_at=NOW() WHERE id=?";
		$values = array($data['password'], $data['id']);
		return $this->db->query($query, $values);
	} 

	public function update_description($data) {
		$query = "UPDATE users SET description=?, updated_at=NOW() WHERE id=?";
		$values = array($data['description'], $data['id']);
		return $this->db->query($query, $values);
	}

	public function delete_user($id) {
		$query = "DELETE FROM users WHERE id=?";
		$value = $id;
		return $this->db->query($query, $value);
	}

	public function create_message($data) {
		$query = "INSERT INTO messages (message, page_user_id, created_user_id, created_at, updated_at) VALUES (?,?,?, Now(), NOW())";
		$values = array($data['message'], $data['page_user_id'], $data['created_user_id']);
		$this->db->query($query, $values);
		return $this->db->insert_id();
	}

	public function create_comment($data) {
		$query = "INSERT INTO comments (comment, message_id, created_user_id, created_at, updated_at) VALUES (?,?,?, NOW(), NOW())";
		$values = array($data['comment'], $data['message_id'], $data['created_user_id']);
		$this->db->query($query, $values);
		return $this->db->insert_id();
	}

// need to decide if I need both this and get_user($id).
	public function profile($id) {
		$query = "SELECT messages.id, message, messages.created_at, CONCAT_WS(' ', creators.first_name, creators.last_name) AS message_name, messages.created_user_id AS user_id 
				  FROM users
				  LEFT JOIN messages
				  ON users.id = messages.page_user_id
				  LEFT JOIN users AS creators
				  ON messages.created_user_id = creators.id
				  WHERE users.id = ?
				  ORDER BY messages.created_at DESC";
		$value = array($id);
		return $this->db->query($query, $value)->result_array();
	}

	public function get_comments($id) {
		$query = "SELECT comments.id, comments.created_at, comments.created_user_id, comment, comments.message_id, CONCAT_WS(' ', first_name, last_name) AS comment_name
				  FROM comments 
				  LEFT JOIN messages
				  ON comments.message_id = messages.id
				  LEFT JOIN users
				  ON comments.created_user_id = users.id
				  WHERE page_user_id =?";
		$value = array($id);
		return $this->db->query($query, $value)->result_array();
	}

}