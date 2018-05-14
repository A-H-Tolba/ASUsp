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
		$this->load->dbforge();
		$this->db->insert('users',$data);
		$str = '<a href="http://localhost/ASUsp/Welcome/user_table?tb='.$data['fname'].$data['lname'].$this->db->get_where('users',array('email'=>$data['email']))->result()[0]->id.'" target="_blank">user\'s data</a>';
		echo $str;
		$this->db->where('email', $data['email']); 
		$this->db->update('users', array('user_table_url' => $str));

		$fields = array(
        	'id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE),
        	'data' => array('type' => 'ENUM("post","friend")', 'null' => FALSE),
        	'content' => array('type' => 'TEXT', 'null' => FALSE),
        	'comments' => array('type' => 'TEXT'),
        	'likes' => array('type' => 'TEXT')
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($data['fname'].$data['lname'].$this->db->get_where('users',array('email'=>$data['email']))->result()[0]->id);
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
      $this->db->like('fname',$username);
      $query = $this->db->get('users');
      return $query->result();
	}
	
	public function get_posts($tableName)
	{
		$query = $this->db->get_where($tableName , array('data' => 'post'));
		return $query->result_array();
	}
	public function did_delete_row($id){
	  $this->db->where('id', $id);
	  $this->db->delete('users');
	}
	public function create_comment($post_id,$userAccount,$comment)
	{
		$query = $this->db->query("SELECT comments FROM $userAccount WHERE id = $post_id;");
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
		return $this->db->update($userAccount, $comm);
	}
	public function create_post($data, $id)
	{
		$this->db->select('fname')->from('users')->where('id' , $id);
		$query = $this->db->get();
		$fName = $query->row()->fname;
		$this->db->select('lname')->from('users')->where('id' , $id);
		$query = $this->db->get();
		$lName = $query->row()->lname;
        $this->db->insert($fName.$lName.$id,$data);
     
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
		$query = $this->db->get_where($tableName , array('data' => 'request'));
		return $query->result_array();
	}

}
