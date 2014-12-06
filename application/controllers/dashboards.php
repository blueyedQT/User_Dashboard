<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboards extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$display['loggedin'] = $this->session->userdata('loggedin');
		$this->load->view('templates/header', $display);
	}

	public function index() {
		$this->load->view('home');
	}

	public function signin() {
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
					if($user['user_level'] > 1) {
						$this->session->set_userdata('admin', $user['user_level']);
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
		redirect('');
	}

	public function register() {
		$display['errors'] = $this->session->flashdata('errors');
		$this->load->view('register', $display);
	}

	public function register_user() {
		//add unique
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
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
		//have yet to decide if users and admin will both draw the same dash or not...
		if(!empty($this->session->userdata('admin'))) {
			redirect('/dashboard/admin', $display);
		} else if(!empty($this->session->userdata('id'))) {
			$this->load->Model('DashboardModel');
			$display['users'] = $this->DashboardModel->get_all_users();
			$this->load->view('user_dashboard', $display);
		} else {
			redirect ('');
		}
	}

	public function admin() {
		if(!empty($this->session->userdata('admin'))) {
			$this->load->Model('DashboardModel');
			$display['users'] = $this->DashboardModel->get_all_users();
			$this->load->view('admin_dashboard', $display);
		} else {
			redirect ('');
		}
	}

	public function profile($id) {
		$this->load->model('DashboardModel');
		$user_info = $this->DashboardModel->get_user($id);
		$display['user_info'] = $user_info;
		$this->load->view('profile', $display);
	}

	public function edit($id) {
// need to be sure that one can only edit if logged in as admin or if they are the logged in user
		$session = $this->session->all_userdata();
		if(!empty($session['admin'])) {
			$this->load->model('DashboardModel');
			$user_info = $this->DashboardModel->get_user($id);
			$admin_levels = $this->DashboardModel->get_admin_levels();
			$display['user_info'] = $user_info;
			$display['admin_levels'] = $admin_levels;
			$this->load->view('edit_user', $display);
		} else {
			redirect('');
		}
	}

	public function edit_user() {
		$admin_id = $this->session->userdata('id');
		$this->load->model('DashboardModel');
		$post = $this->input->post();
//need to validate form information
		$user['email'] = $post['email'];
		$user['first_name'] = $post['first_name'];
		$user['last_name'] = $post['last_name'];
		$user['user_level'] = $post['user_level'];
		$user['updated_by'] = $admin_id;
		$user['id'] = $post['id'];
		$result = $this->DashboardModel->update_user($user);
		if($result> 0) {
			$this->session->set_flashdata('message', $message);
			$display['message'] = $this->session->flashdata('message');
			redirect('dashboard', $display);
		} 
	}

	public function delete_user($id) {
		$this->load->model('DashboardModel');
		$this->DashboardModel->delete_user($id);
		redirect('dashboard/admin');
	}

	public function add_new() {
		if(!empty($this->session->userdata('admin'))) {
			$this->load->view('add_user');
		} else {
			redirect('register');
		}
	}
}