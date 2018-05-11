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
		if($this->session->has_userdata('logged_in'))
		{
			$id = $this->session->userdata['user_id'];
			if($id == 0){redirect('Welcome/ad_account');}
		 else {redirect('Welcome/account');}
		}

		
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
        	$config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['overwrite']             = TRUE;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile'))
            {
                    //$error = array('error' => $this->upload->display_errors());

                    //$this->load->view('upload_form', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $filename = $this->upload->data('file_name');
            }
			$data = array(
				'email' => $this->input->post('email'),
				'fname' => $this->input->post('fname'),
				'lname' => $this->input->post('lname'),
				'Password'=> $this->input->post('password'),
				'pic' => $filename
			);
			$this->Users_model->insertData($data);
			redirect('Welcome/index');
		}
	}
	public function login()
	{
		$data['auth_error'] = '';
		$email = $this->input->post ('email') ;
		$password = $this->input->post ('password') ;
		$userdata = $this->Users_model->authenticate ( $email , $password) ;
		if($email == 'admin@m.com'){
			if($email != 'admin@m.com' || $password != 'admin'){
			$userdata = false;
		}
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
					'user_name' => $userdata['fname']." ".$userdata['lname'],
					'logged_in' => true
			)) ;
			$this->session->set_flashdata ( 'notification_success' , "You have successfully logged in." );
			redirect('Welcome/ad_account');
		}
		}
		else
		{
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
						'user_name' => $userdata['fname']." ".$userdata['lname'],
						'logged_in' => true
				)) ;
				$this->session->set_flashdata ( 'notification_success' , "You have successfully logged in." );
				redirect('Welcome/account');
			}
		}
	}

	public function account()
	{
		$data['session'] = $this->session->userdata;
		$id = $this->session->userdata['user_id'];
		$userName = $this->session->userdata['user_name'];
		$data['posts'] = $this->Users_model->get_posts($userName.$id);
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
		
		$data['session'] = $this->session->userdata;
		$id = $this->session->userdata['user_id'];
		
		$this->load->view('header', $data);
		$this->load->view('profile', $data);
		
	}
	public function ad_account()
	{
		$data['session'] = $this->session->userdata;
		$id = $this->session->userdata['user_id'];
		
		$this->load->view('header', $data);
		$this->load->view('admin_control', $data);
	}
	public function delete()
	{

		$id = $this->input->post('delid');
		$this->load->model('Users_model');
    	$this->Users_model->did_delete_row($id);
  		redirect('Welcome/ad_account');
	}
	public function ad_search()
	{
		$data['session'] = $this->session->userdata;
		$username = $this->input->post('username');
		$data1['users'] = $this->Users_model->search($username);
		$this->load->view('header', $data);
		$this->load->view('ad_search_res', $data1);
	}
	public function create_post(){
		$data_name['session'] = $this->session->userdata;
		$id = $this->session->userdata['user_id'];
		$data = array(
				'content' => $this->input->post('body'),
			);
		$this->Users_model->create_post($data,$id);
		redirect('Welcome/account');
	}

	public function addComment($post_id)
 	{
		$data['session'] = $this->session->userdata;
 		$id = $this->session->userdata['user_id'];
 		$userName = $this->session->userdata['user_name'];
 		$userAccount = $userName.$id;
 		$comment = $this->input->post('comment');
 		$this->load->library('form_validation');
 		$this->form_validation->set_rules('comment', 'Comment', 'required');
 		if($this->form_validation->run() === FALSE){
 			$this->load->view('header', $data);
 			$this->load->view('profile', $data);
 		} else {
 			$this->Users_model->create_comment($post_id,$userAccount,$comment);
			// $this->load->view('header', $data);
		// $this->load->view('profile', $data);
		redirect('Welcome/account');
 		}
	 }
	 
	public function Like($post_id)
	{
		$data['session'] = $this->session->userdata;
 		$id = $this->session->userdata['user_id'];
 		$userName = $this->session->userdata['user_name'];
		$userAccount = $userName.$id;
		$this->Users_model->like_post($post_id,$userAccount);
		redirect('Welcome/account');
	}
 
}
class friendcontroller extends  CI_Controller
{ 
	public function getIndex()
	{ $friend= Auth :: user()->friends();
	  $requests = Auth :: user()->friendRequests();


	  return view ('friends.index')
	  ->with('friends',$friends)
      ->with('requests',$requests);

	}
	
	
	public function getAdd($username)
	{ dd($username);

	}

}




