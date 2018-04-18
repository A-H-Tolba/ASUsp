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
		$this->load->view('asusp');
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
				'username' => $this->input->post('name'),
				'Password'=> $this->input->post('password')
			);
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
			print_r($this->session->userdata) ;
		}
	}
}
