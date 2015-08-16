<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboards extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->session->sess_destroy();
		$display['loggedin'] = $this->session->userdata('loggedin');
		$display['user'] = $this->session->userdata('id');
		$display['name'] = $this->session->userdata('name');
		$this->load->view('templates/header', $display);
	}

	public function index() {
		if($this->session->userdata('loggedin') == TRUE){
			redirect('dashboard');
		}
		$this->load->view('home');
	}

	public function signin() {
		if($this->session->userdata('loggedin')){
			redirect('dashboard');
		}
		$display['errors'] = $this->session->flashdata('errors');
		$this->load->view('signin', $display);
	}

	public function signin_user() {
		$post = $this->input->post();
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->view_data['errors'] = validation_errors();
			$this->session->set_flashdata('errors', $this->view_data['errors']);
			redirect('signin');
		} else {
			$this->load->model('DashboardModel');
			$email = $post['email'];
			$password = $post['password'];
			$user = $this->DashboardModel->login_db($email);
			if ($user != NULL) {
				if(crypt($password, $user['password']) == $user['password']) {
					$this->session->set_userdata('id', $user['id']);
					$this->session->set_userdata('loggedin', TRUE);
					$this->session->set_userdata('name', $user['first_name']);
					if($user['user_level'] == "2") {
						$this->session->set_userdata('admin', TRUE);
					}
					redirect('dashboard');
				}
			}
			$this->session->set_flashdata('errors', 'The email and password combination is not valid');
			redirect('signin');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		$this->session->set_userdata('');
		// $this->session->set_userdata('admin', FALSE);
		// var_dump($this->session->all_userdata());
		// die('Logout');
		redirect('');
	}

	public function register() {
		if($this->session->userdata('loggedin')){
			redirect('dashboard');
		}
		$display['errors'] = $this->session->flashdata('errors');
		$this->load->view('register', $display);
	}

	public function add_new() {
		var_dump($this->session->all_userdata());
		die('Made it to add new');
		if($this->session->userdata('admin')) {
			$this->load->view('add_user');
		} else {
			redirect('register');
		}
	}

	public function register_user() {
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|alpha|min_length[2]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|alpha|min_length[2]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');
		if($this->form_validation->run() == FALSE) {
			$this->view_data['errors'] = validation_errors();
			$this->session->set_flashdata('errors', $this->view_data['errors']);
			redirect('register');
		} else {
			$this->load->model('DashboardModel');
			$post = $this->input->post();
			$email = $this->DashboardModel->check_email($post['email']);
			$model = array();
			$model['first_name'] = $post['first_name'];
			$model['last_name'] = $post['last_name'];
			$model['email'] = $post['email'];
			$pass = $post['password'];
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$hash = crypt($pass, $salt);
			$model['password'] = $hash;
			$add_user = $this->DashboardModel->register_user($model);
			if($add_user == FALSE) {
				$this->session->set_flashdata['errors'] = 'There was a system error, please try again.';
				redirect('register');
			}
			$this->session->set_userdata('loggedin', TRUE);
			$this->session->set_userdata('id', $add_user);
			redirect('dashboard');	
		}	
	}

	public function dashboard() {
		if($this->session->userdata('admin')) {
			redirect('admin');
			// redirect('/dashboard/admin', $display);
		} else 
		if($this->session->userdata('id')) {
			$this->load->Model('DashboardModel');
			$display['users'] = $this->DashboardModel->get_all_users();
			$this->load->view('user_dashboard', $display);
		} else {
			redirect('');
		}
	}

	public function admin() {
		if($this->session->userdata('admin')) {
			$this->load->Model('DashboardModel');
			$display['users'] = $this->DashboardModel->get_all_users();
			$this->load->view('admin_dashboard', $display);
		} else {
			redirect('');
		}
	}

	public function profile($id) {
		if($this->session->userdata('loggedin')) {
			$this->load->model('DashboardModel');
			$display['user_info'] = $this->DashboardModel->get_user($id);
			$display['errors'] = $this->session->flashdata('errors');
			$display['messages'] = $this->DashboardModel->profile($id);
			$display['comments'] = $this->DashboardModel->get_comments($id);
			$this->load->view('profile', $display);
		} else {
			redirect('');
		}
	}

	public function edit($id) {
		if($this->session->userdata('admin')) {
			$this->load->model('DashboardModel');
			$user_info = $this->DashboardModel->get_user($id);
			$admin_levels = $this->DashboardModel->get_admin_levels();
			$display['user_info'] = $user_info;
			$display['errors'] = $this->session->flashdata('errors');
			$display['admin_levels'] = $admin_levels;
			$display['errors_password'] = $this->session->flashdata('errors_password');
			$display['message'] = $this->session->flashdata('message');
			$this->load->view('edit_user', $display);
			var_dump($display);
			die('yies');
		} else {
			redirect('edit_profile');
		}
	}

	public function edit_profile() {
		$id = $this->session->userdata('id');
		if($id) {
			$display['message'] = $this->session->flashdata('message');
			$display['errors'] = $this->session->flashdata('errors');
			$display['errors_password'] = $this->session->flashdata('errors_password');
			$display['errors_description'] = $this->session->flashdata('errors_description');
			$this->load->model('DashboardModel');
			$display['user_info'] = $this->DashboardModel->get_user($id);
			$this->load->view('edit_profile', $display);
		} else {
			redirect('');
		}
	}

	public function edit_user() {
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|alpha|min_length[2]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|alpha|min_length[2]');
		if($this->form_validation->run() == FALSE) {
			$this->view_data['errors'] = validation_errors();
			$this->session->set_flashdata('errors', $this->view_data['errors']);
			redirect_back();
		}
		$updater_id = $this->session->userdata('id');
		$this->load->model('DashboardModel');
		$post = $this->input->post();
		$user['email'] = $post['email'];
		$user['first_name'] = $post['first_name'];
		$user['last_name'] = $post['last_name'];
		$user['updated_by'] = $updater_id;
		$user['id'] = $post['id'];
		if($updater_id !== $post['id']) {
			$user['user_level'] = $post['user_level'];
			$result = $this->DashboardModel->admin_update_user($user);
		} else {
			$result = $this->DashboardModel->update_user($user);
		}
		if($result > 0) {
			$message = 'You have sucessfully edited the personal information.';
			$this->session->set_flashdata('message', 'You have sucessfully edited the personal information.');
		}
		redirect_back();
	}

	public function edit_password() {
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');
		if($this->form_validation->run() == FALSE) {
			$this->view_data['errors'] = validation_errors();
			$this->session->set_flashdata('errors_password', $this->view_data['errors']);
			redirect_back();
		}
		$model = $this->input->post();
		$pass = $model['password'];
		$salt = bin2hex(openssl_random_pseudo_bytes(22));
		$hash = crypt($pass, $salt);
		$model['password'] = $hash;
		$result = $this->DashboardModel->update_password($model);
		if($result > 0) {
			$message = 'You have successfully updated the password.';
			$this->session->set_flashdata('message', $message);
			redirect_back();
		}  
	}

	// public function edit_description() {
	// 	$this->form_validation->set_rules('description', 'Profile Description', 'required|trim|alpha|min_length[2]');
	// 	if($this->form_validation->run() == FALSE) {
	// 		$this->view_data['errors'] = validation_errors();
	// 		$this->session->set_flashdata('errors_description', $this->view_data['errors']);
	// 		redirect_back();
	// 	}
	// 	$user['description'] = $this->input->post('description');
	// 	$user['id'] = $this->input->post('id');
	// 	$result = $this->DashboardModel->update_description($user);
	// 	if($result > 0) {
	// 		$message = 'You have successfully updated your profile description.';
	// 		$this->session->set_flashdata('message', $message);
	// 		redirect('edit_profile');
	// 	} 
	// }

	// public function delete_user($id) {
	// 	if($this->session->userdata('admin')) {
	// 		$this->load->model('DashboardModel');
	// 		$this->DashboardModel->delete_user($id);
	// 		redirect('dashboard/admin');
	// 	} else {
	// 		redirect('');
	// 	}
	// }

	// public function message($id) {
	// 	$this->form_validation->set_rules('message', 'Message', 'required|min_length[6]');
	// 	if($this->form_validation->run() == FALSE) {
	// 		$this->view_data['errors'] = validation_errors();
	// 		$this->session->set_flashdata('errors', $this->view_data['errors']);
	// 		redirect_back();
	// 	}
	// 	$data['message'] = $this->input->post('message');
	// 	$data['page_user_id'] = $id;
	// 	$data['created_user_id'] = $this->session->userdata('id');
	// 	$result = $this->DashboardModel->create_message($data);
	// 	if($result > 0) {
	// 		$display['message_id'] = $result;
	// 		$display['action'] = 'add_message';
	// 		$display['user_id'] = $data['created_user_id'];
	// 		$display['message'] = $data['message'];
	// 		exit(json_encode($display));
	// 	}
	// }

	// public function comment ($id) {
	// 	$this->form_validation->set_rules('comment', 'Comment', 'required|min_length[2]');
	// 	if($this->form_validation->run() == FALSE) {
	// 		$this->view_data['errors'] = validation_errors();
	// 		$this->session->set_flashdata('errors', $this->view_data['errors']);
	// 		redirect_back();
	// 	}
	// 	$data['comment'] = $this->input->post('comment');
	// 	$data['message_id'] = $id;
	// 	$data['created_user_id'] = $this->session->userdata('id');
	// 	$user = $this->input->post('id');
	// 	$result = $this->DashboardModel->create_comment($data);
	// 	if($result > 0) {
	// 		$display['comment_id'] = $result;
	// 		$display['action'] = 'add_comment';
	// 		$display['user_id'] = $data['created_user_id'];
	// 		$display['comment'] = $data['comment'];
	// 		$display['message_id'] = $data['message_id'];
	// 		exit(json_encode($display));
	// 	}
	// }

}