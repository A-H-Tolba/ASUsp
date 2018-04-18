<?php
class Users_model extends CI_Model
{
	//example of a model function
	function get_data($table_name)
	{
		$query = $this->db->get_where($table_name,array('active'=>'yes'))->result();
		return $query;
	}
	function authenticate ( $email , $password )
    {
    	$password = md5 ( $password ) ;
    	$return = $this->db->get_where ( 'users' , array (
    			'email' => $email ,
    			'password' => $password,
          'is_active'=>'yes'
    	))->row_array();
    	if (empty ($return ) )
    	{
    		return false ;
    	}else
    	{
    		return $return ;
    	}
    }
}