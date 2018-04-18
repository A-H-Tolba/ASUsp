<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
				'user' => $this->input->post('name'),
				'Password'=> $this->input->post('password')
			);
		}
	}
}
