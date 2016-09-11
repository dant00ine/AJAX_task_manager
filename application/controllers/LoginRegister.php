<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginRegister extends CI_Controller {

	public function index(){
		$this->load->view('login_register_view');
	}

	public function register(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules("first_name", "First Name", "trim|required|alpha");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required|alpha");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "required|matches[confirm_password]");
		$this->form_validation->set_rules("confirm_password", "Password", "required");

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', validation_errors());
			redirect(base_url());
		} else { // success
			$this->session->set_flashdata('success', 'You have successfully registered!');
			$this->load->model('users_model');

			$this->load->library('encrypt');
			$hash = $this->encrypt->sha1($this->input->post('password'));

			$user_details = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => $hash
			);
			$add_user = $this->users_model->add_user($user_details);

			redirect(base_url());
		}
	}

	public function signin(){
		$this->load->model('users_model');
		$email = $this->input->post('email');

		$this->load->library('encrypt');
		$password = $this->encrypt->sha1($this->input->post('password'));
		$get_user = $this->users_model->login_user($email);

		if($get_user && $get_user['password'] == $password){
			$user = array(
				'id' => $get_user['id'],
				'first_name' => $get_user['first_name'],
				'last_name' => $get_user['last_name'],
				'email' => $get_user['email']
			);
			$this->session->set_userdata('user', $user);

			redirect(base_url('wall_view'));
		} else {
			$this->session->set_flashdata('errors', 'Invalid email or password');
			redirect(base_url());
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
/* End of file LoginRegister.php */
/* Location: ./application/controllers/LoginRegister.php */
?>
