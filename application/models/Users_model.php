<?php
class Users_model extends CI_Model
{
	//example of a model function
	function get_data($table_name)
	{
		$query = $this->db->get_where($table_name,array('active'=>'yes'))->result();
		return $query;
	}
	function insertData($data)
	{
		//$this->load->dbforge();
		$this->db->insert('users',$data);
		/*$str = '<a href="http://localhost/ASUsp/Welcome/user_table?tb='.$data['fname'].$data['lname'].$this->db->get_where('users',array('email'=>$data['email']))->result()[0]->id.'" target="_blank">user\'s data</a>';
		echo $str;
		$this->db->where('email', $data['email']); 
		$this->db->update('users', array('user_table_url' => $str));

		$fields = array(
        	'id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE),
        	'data' => array('type' => 'ENUM("post","friend","pending_request")', 'null' => FALSE),
        	'content' => array('type' => 'TEXT', 'null' => FALSE),
        	'comments' => array('type' => 'TEXT'),
        	'likes' => array('type' => 'TEXT'),
		'pending_requests'=> array('type' => 'TEXT')
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($data['fname'].$data['lname'].$this->db->get_where('users',array('email'=>$data['email']))->result()[0]->id);*/
	}
	function authenticate ( $email , $password )
    {
    	//$password = md5 ( $password ) ;
    	$return = $this->db->get_where ( 'users' , array (
    			'email' => $email ,
    			'password' => $password//,
          //'is_active'=>'yes'
    	))->row_array();
    	if (empty ($return ) )
    	{
    		return false ;
    	}else
    	{
    		return $return ;
    	}
    }
    	public function search($username)
    {
    	$space = strrpos($username, " ");
    	if ($space)
    	{
    		$fname = substr($username, 0, $space);
    		$lname = substr($username, $space+1);
    		$this->db->like('fname',$fname);
		    $this->db->like('lname',$lname);
		    $query = $this->db->get('users');
    	}
    	else
    	{
    		$this->db->like('fname',$username);
		    $this->db->or_like('lname',$username);
		    $query = $this->db->get('users');
    	}
	    return $query->result();
	}
	
	/*public function get_posts($tableName)
	{
		$query = $this->db->get_where($tableName , array('data' => 'post'));
		return $query->result_array();
	}*/
	public function get_posts($id)
	{
		$query = $this->db->get_where('posts' , array('user_id' => $id));
		return $query->result_array();
	}
	public function did_delete_row($id){
	  $this->db->where('id', $id);
	  $this->db->delete('users');
	}
	public function create_comment($post_id, $comment)
	{
		$query = $this->db->query("SELECT comments FROM posts WHERE id = $post_id;");
		$comments = "";
		foreach ($query->result() as $row)
		{
				$comments=$comments.$row->comments;
				$comments=$comments."\n";
		}
		$comments=$comments.$comment;
		$this->db->where('id',$post_id);
		$comm = array(
			'comments' => $comments,
		);
		return $this->db->update('posts', $comm);
	}
	/*public function create_post($data, $id)
	{
		$this->db->select('fname')->from('users')->where('id' , $id);
		$query = $this->db->get();
		$fName = $query->row()->fname;
		$this->db->select('lname')->from('users')->where('id' , $id);
		$query = $this->db->get();
		$lName = $query->row()->lname;
        $this->db->insert($fName.$lName.$id,$data);
     
	}*/
	public function create_post($data)
	{
        $this->db->insert('posts',$data);
	}
	public function like_post($post_id,$userAccount)
	{
		
		$query = $this->db->query("SELECT likes FROM $userAccount WHERE id = $post_id;");
		foreach ($query->result() as $row)
		{
				echo $row->likes;
		}
		if($row->likes != '1')
		{
			$like = array
			(
				'likes' => '1',
			);
		}
		else
		{
			$like = array
			(
				'likes' => '0',
			);
		}
		$this->db->where('id',$post_id);
		return $this->db->update($userAccount, $like);

	}

	public function get_requests($tableName)
	{
		$query = $this->db->get_where($tableName , array('data' => 'pending_request'));
		return $query->result_array();
	}

	public function get_suggestions($id)
	{
		
	}
	public function send_request($id_user,$id_friend)
	{
		$this->db->select('fname')->from('users')->where('id' , $id_friend);
		$query = $this->db->get();
		$fName = $query->row()->fname;
		$this->db->select('lname')->from('users')->where('id' , $id_friend);
		$query = $this->db->get();
		$lName = $query->row()->lname;
		//$this->db->select('user_table_url')->from('users')->where('id' , $id_user);
		//$query = $this->db->get();
		$this->db->select('fname')->from('users')->where('id' , $id_user);
		$query = $this->db->get();
		$fName1 =$query->row()->fname;
		$this->db->select('lname')->from('users')->where('id' , $id_user);
		$query = $this->db->get();
		$lName1 = $query->row()->lname;
		$content = 'http://localhost/ASUsp/Welcome/account/'.$fName1.$lName1.$id_user;
		$tableName = $fName.$lName.$id_friend;
		$PR = array(
			'data' => 'pending_request',
			'content' => $content,
			'comments' => $fName1.' '.$lName1,
			'pending_requests' => $id_user,
		);
		return $this->db->insert($fName.$lName.$id_friend, $PR);
	}

	public function get_friend($friend_id)
	{
		$query = $this->db->get_where('users' , array('id' => $friend_id));
		return $query->result_array();
	}

		public function acceptFriend($request,$tableName)
	{
		$this->db->where('pending_requests',$request);
		$comm = array(
			'data' => 'friend',
		);
		return $this->db->update($tableName, $comm);
	}

	public function addFriend($request,$tableName,$id)
	{
		$this->db->select('fname')->from('users')->where('id' , $id);
		$query = $this->db->get();
		$fName =$query->row()->fname;
		$this->db->select('lname')->from('users')->where('id' , $id);
		$query = $this->db->get();
		$lName = $query->row()->lname;
		$this->db->select('id')->from('users')->where('id' , $id);
		$query = $this->db->get();
		$uid = $query->row()->id;

		$this->db->select('fname')->from('users')->where('id' , $request);
		$query = $this->db->get();
		$tfName =$query->row()->fname;
		$this->db->select('lname')->from('users')->where('id' , $request);
		$query = $this->db->get();
		$tlName = $query->row()->lname;
		$this->db->select('id')->from('users')->where('id' , $request);
		$query = $this->db->get();
		$tid = $query->row()->id;

		$table = $tfName.$tlName.$tid;

		$comm = array(
			'data' => 'friend',
			'content' => 'http://localhost/ASUsp/Welcome/account/'.$fName.$lName.$uid,
			'comments' => $fName." ".$lName,
			'pending_requests' => $uid,
		);
		return $this->db->insert($table, $comm);

	}

	public function rejectFriend($request,$tableName)
	{
		$this->db->where('pending_requests',$request);
		$this -> db -> delete($tableName);
	}
	public function is_friend($friend_id,$user_id)
	{
		$this->db->select('fname')->from('users')->where('id' , $user_id);
		$query = $this->db->get();
		$fName =$query->row()->fname;
		$this->db->select('lname')->from('users')->where('id' , $user_id);
		$query = $this->db->get();
		$lName = $query->row()->lname;
		$tableName = $fName.$lName.$user_id;
		$this->db->select('data')->from($tableName)->where('pending_requests', $friend_id);
		$query = $this->db->get();
		$status = $query->result_array();
		if (!empty($status) && $status[0]['data'] == 'friend'){
			return true;
		}
		else {return false;}
	}

	public function get_fPosts($id,$tableName)
	{
		$query = $this->db->get_where($tableName , array('data' => 'friend'));
		$friends = $query->result_array();
		$fPosts = array();
		if(count($friends) != 0)
		{
			foreach($friends as $friend)
			{
				$this->db->select('fname')->from('users')->where('id' , $friend['pending_requests']);
				$query = $this->db->get();
				$tfName =$query->row()->fname;
				$this->db->select('lname')->from('users')->where('id' , $friend['pending_requests']);
				$query = $this->db->get();
				$tlName = $query->row()->lname;
				$table = $tfName.$tlName.$friend['pending_requests'];

				$query = $this->db->get_where($table , array('data' => 'post'));
				$posts = $query->result_array();
				
				foreach($posts as $post){
					$post['table'] = $table;
					array_push($fPosts,$post);
				}
			}
		}
		return $fPosts;
	}
	public function friend_list($user_id){
		/*$this->db->select('fname')->from('users')->where('id' , $user_id);
		$query = $this->db->get();
		$tfName =$query->row()->fname;
		$this->db->select('lname')->from('users')->where('id' , $user_id);
		$query = $this->db->get();
		$tlName = $query->row()->lname;
		$table = $tfName.$tlName.$user_id;
		$query = $this->db->get_where($table , array('data' => 'friend'));
		$friends = $query->result_array();
		$friendsl = array();
		foreach ($friends as $friend) {
			$id = $friend['pending_requests'];
			$this->db->select('fname')->from('users')->where('id',$id);
			$query = $this->db->get();
			$fName =$query->row()->fname;
			$this->db->select('lname')->from('users')->where('id',$id);
			$query = $this->db->get();
			$lName = $query->row()->lname;
			$this->db->select('pic')->from('users')->where('id',$id);
			$query = $this->db->get();
			$pic = $query->row()->pic;
			array_push($friendsl, $id ,$fName.' '.$lName,$pic); 
		}
		return $friendsl;*/
		$list = array();
		foreach ($user_id as $user) {
			$friend['id'] = $user;
			$friend['username'] = $this->db->get_where('users',array('id'=>$user))->result()[0]->fname." ".$this->db->get_where('users',array('id'=>$user))->result()[0]->lname;
			$friend['pic'] = $this->db->get_where('users',array('id'=>$user))->result()[0]->pic;
			array_push($list,$friend);
		}
		return $list;
	}
	public function friends_id($user_id)
	{
		$str = $this->db->get_where('users',array('id'=>$user_id))->result()[0]->friends;
		parse_str($str, $id);
		return $id['id'];
	}


}
