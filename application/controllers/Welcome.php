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
				'pic' => ($filename)? $filename : 'default.png'
			);
			$this->Users_model->insertData($data);
			redirect('Welcome/index');
		}
	}
	public function login()
	{
		$data['auth_error'] = '';
		$data['friendStatus'] = false;
		$email = $this->input->post ('email') ;
		$password = $this->input->post ('password') ;
		$userdata = $this->Users_model->authenticate ( $email , $password) ;
		if ( $userdata === false  )
		{
				$data ['auth_error'] = 'The email and password don\'t match.'  ;
				echo $data ['auth_error'] ;
		}
		elseif ($email == 'admin@m.com' && $password == 'admin')
		{
			$this->session->set_userdata (array (
					'email' => $userdata['email'] ,
					'user_id' => $userdata['id'],
					'user_name' => $userdata['fname']." ".$userdata['lname'],
					'logged_in' => true
			)) ;
			$this->session->set_flashdata ( 'notification_success' , "You have successfully logged in." );
			redirect('Welcome/admin_index');
		}
		else
		{
			$this->session->set_userdata (array (
					'email' => $userdata['email'] ,
					'user_id' => $userdata['id'],
					'user_name' => $userdata['fname']." ".$userdata['lname'],
					//'tableName' => $userdata['fname'].$userdata['lname'].$userdata['id'],
					'friends_id' => $this->Users_model->friends_id($userdata['id']),
					'pic' => $userdata['pic'],
					'logged_in' => true
			)) ;
			$this->session->set_flashdata ( 'notification_success' , "You have successfully logged in." );
			redirect('Welcome/account');
		}
	}

	public function feed()
	{
		$data['session'] = $this->session->userdata;
		$data['posts'] = $this->Users_model->get_posts($this->session->userdata['user_id']);
		//$data['fPosts'] = $this->Users_model->get_fPosts($this->session->userdata['user_id'],$this->session->userdata['tableName']);
		$data['friendStatus'] = false;
		$this->load->view('header', $data);
		$this->load->view('feed', $data);
	}
	public function f_feed($friend_id)
	{
		$data['session'] = $this->session->userdata;
		$data['friendInfo'] = $this->Users_model->get_friend($friend_id);
		$data['friendStatus'] = true;
		$data['posts'] = $this->Users_model->get_posts($data['friendInfo'][0]['fname'].$data['friendInfo'][0]['lname'].$data['friendInfo'][0]['id']);
		
		$this->load->view('header', $data);
		$this->load->view('Ffeed', $data);
	}


	public function account()
	{
		$data['session'] = $this->session->userdata;
		//$tableName = $this->session->userdata['tableName'];
		//$data['posts'] = $this->Users_model->get_posts($tableName);
		$data['myposts'] = $this->Users_model->get_posts($this->session->userdata['user_id']);
		$data['friendStatus'] = false;
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
		$data['friendStatus'] = false;
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
		/*$data_name['session'] = $this->session->userdata;
		$id = $this->session->userdata['user_id'];
		$data = array(
				'content' =>'<a href="'.base_url().'Welcome/getFriend/'.$id.'">'.$data_name['session']['user_name'].'</a>'." Wrote \r\n".$this->input->post('body'),
			);
		$this->Users_model->create_post($data,$id);*/
		$data = array(
			'user_id' => $this->session->userdata['user_id'],
			'post' => $this->input->post('body'),
			'likes_num' => 0
		);
		$this->Users_model->create_post($data);
		redirect('Welcome/feed');
	}

	public function addComment($post_id)
 	{
 		$comment = '<a href="'.base_url().'Welcome/getFriend/'.$this->session->userdata['user_id'].'">'.$this->session->userdata['user_name'].'</a>'." Commented : ".$this->input->post('comment');
 		$this->load->library('form_validation');
 		$this->form_validation->set_rules('comment', 'Comment', 'required');
 		if($this->form_validation->run() === FALSE){
 			$this->load->view('header', $data);
 			$this->load->view('profile', $data);
 		} else {
 			$this->Users_model->create_comment($post_id, $comment);
			// $this->load->view('header', $data);
		// $this->load->view('profile', $data);
		redirect('Welcome/feed');
 		}
	 }
	 public function faddComment($writer_id,$post_id)
 	{
		$data['session'] = $this->session->userdata;
		$data['writer'] = $this->Users_model->get_friend($writer_id);
 		$id = $data['writer'][0]['id'];
		$nid = $this->session->userdata['user_id'];
 		$fName = $data['writer'][0]['fname'];
		$lName = $data['writer'][0]['lname'];
		$tableName = $fName.$lName.$id;
 		$comment = '<a href="'.base_url().'Welcome/getFriend/'.$nid.'">'.$data['session']['user_name'].'</a>'." Commented : ".$this->input->post('comment');
 		$this->load->library('form_validation');
 		$this->form_validation->set_rules('comment', 'Comment', 'required');
 		if($this->form_validation->run() === FALSE){
 			$this->load->view('header', $data);
 			$this->load->view('profile', $data);
 		} else {
 			$this->Users_model->create_comment($post_id,$tableName,$comment);
			// $this->load->view('header', $data);
		// $this->load->view('profile', $data);
		redirect('Welcome/f_feed/'.$id);
 		}
	 }
	 public function Like($post_id)
	 {
		 $data['session'] = $this->session->userdata;
	  // 	$id = $this->session->userdata['user_id'];
	  // 	$userName = $this->session->userdata['user_name'];
		 // $userAccount = $userName.$id;
		 //$tableName = $this->session->userdata['tableName'];
		 $email = $this->session->userdata['email'];
		 $this->Users_model->like_post($post_id,$email);
		 redirect('Welcome/feed');
	 }
	public function fLike($writer_id,$post_id)
	{
		$data['session'] = $this->session->userdata;
		$data['writer'] = $this->Users_model->get_friend($writer_id);
 		$id = $data['writer'][0]['id'];
 		$fName = $data['writer'][0]['fname'];
		$lName = $data['writer'][0]['lname'];
		$tableName = $fName.$lName.$id;
		$this->Users_model->like_post($post_id,$tableName);
		redirect('Welcome/f_feed/'.$id);
	}

	public function requests()
	{
		$data['session'] = $this->session->userdata;
		$tableName = $this->session->userdata['tableName'];
		$data['requests'] = $this->Users_model->get_requests($tableName);

		$data['friendStatus'] = false;
		$this->load->view('header', $data);
		$this->load->view('requests', $data);
	}
	public function suggestion()
	{
		$data['session'] = $this->session->userdata;
		$id = $this->session->userdata['user_id'];
		$data['suggestions'] = $this->Users_model->get_suggestions($id);
	}
	public function pending_requests()
	{
		$data['session'] = $this->session->userdata;
		$id_user = $this->session->userdata['user_id'];
		$id_friend = $this->input->get('c');
		$this->Users_model->send_request($id_user,$id_friend);
			redirect('Welcome/account');

	}
	public function admin_index()
	{

		$data['friendStatus'] = false;
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('users');
		$crud->display_as('fname','First name')
			 ->display_as('lname','Last name')
			 ->display_as('pic','Profile picture')
			 ->display_as('user_table_url','User\'s account');
		$crud->unset_add();
		$output = $crud->render();
		$this->_example_output($output);
	}
	public function user_table()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table(strtolower($_GET['tb']));
		$crud->unset_add();
		$output = $crud->render();
		$this->_example_output($output);
	}
	public function _example_output($output = null)
	{
		
		$data['friendStatus'] = false;
		$data['session'] = $this->session->userdata;
		$this->load->view('header', $data);
		$this->load->view('example.php',(array)$output);
	}
	public function getFriend($friend_id)
	{
		$data['session'] = $this->session->userdata;
		$id_user = $this->session->userdata['user_id'];
		if($id_user != $friend_id)
		{
			$data['friendInfo'] = $this->Users_model->get_friend($friend_id);
				$data['friendStatus'] = $this->Users_model->is_friend($friend_id,$this->session->userdata['user_id']);
				$this->load->view('header', $data);
				$this->load->view('Fprofile', $data);
		}
		else{
			redirect('Welcome/account');
		}
	}
	public function accept($request)
	{
		$data['session'] = $this->session->userdata;
		$tableName = $this->session->userdata['tableName'];
		$id = $this->session->userdata['user_id'];
		$this->Users_model->acceptFriend($request,$tableName);
		$this->Users_model->addFriend($request,$tableName,$id);
		redirect('Welcome/feed');
	}

	public function reject($request)
	{
		$data['session'] = $this->session->userdata;
		$tableName = $this->session->userdata['tableName'];
		$this->Users_model->rejectFriend($request,$tableName);
		redirect('Welcome/feed');
	}
	public function friend_list()
	{
		$data['session'] = $this->session->userdata;
		$data['friends'] = ($this->Users_model->friend_list($this->session->userdata['friends_id']));
		$data['friendStatus'] = false;
		$this->load->view('header', $data);
		$this->load->view('fList', $data);
	}
}
