<?php
class Users_model extends CI_Model
{
	//example of a model function
	function get_data($table_name)
	{
		$query = $this->db->get_where($table_name,array('active'=>'yes'))->result();
		return $query;
	}
	function insertData()
	{
		$this->db->insert('users',$data);
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
	
	public function get_posts($id)
	{
		$query = $this->db->get_where('posts' , array('user_id' => $id));
		return $query->result_array();
	}
}
