<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Users_model');
	}
	public function index()
	{
		if($this->session->has_userdata('logged_in')) redirect('Welcome/account');
		$this->load->view('header');
		$this->load->view('home');
	}
	public function signup()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|is_unique[users.email]|valid_email');
		if ($this->form_validation->run() == FALSE)
		{
			$valid['valid']=FALSE;
		}
        else {
        	$valid['valid']=TRUE;
			$data = array(
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'Password'=> $this->input->post('password')
			);
			$this->db->insert('users',$data);
		}
	}
	public function login()
	{
		$data['auth_error'] = '';
		$email = $this->input->post ('email') ;
		$password = $this->input->post ('password') ;
		$userdata = $this->Users_model->authenticate ( $email , $password) ;
		if ( $userdata === false  )
		{
			$data ['auth_error'] = 'The email and password don\'t match.'  ;
			echo $data ['auth_error'] ;
		}
		else
		{
			$this->session->set_userdata (array (
					'email' => $userdata['email'] ,
					'user_id' => $userdata['id'],
					'logged_in' => true
			)) ;
			$this->session->set_flashdata ( 'notification_success' , "You have successfully logged in." );
			redirect('Welcome/account');
		}
	}

	public function account()
	{
		$data['session'] = $this->session->userdata;
		$id = $this->session->userdata['user_id'];
		$data['posts'] = $this->Users_model->get_posts($id);
		$this->load->view('header', $data);
		$this->load->view('profile', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->view('header');
		$this->load->view('home');
	}
	public function search()
	{
		$username = $this->input->post('username');
		$data['users'] = $this->Users_model->search($username);
		$this->load->view('search_res', $data);
	}
}
