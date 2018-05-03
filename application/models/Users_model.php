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
		$fields = array(
        	'id' => array('type' => 'INT', 'unsigned' => TRUE, 'auto_increment' => TRUE),
        	'data' => array('type' => 'ENUM("post","friend")', 'null' => FALSE),
        	'comments' => array('type' => 'TEXT'),
        	'likes' => array('type' => 'TEXT')
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($data['username'].$this->db->get_where('users',array('email'=>$data['email']))->result()[0]->id);
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
      $this->db->like('username',$username);
      $query = $this->db->get('users');
      return $query->result();
    }
}
