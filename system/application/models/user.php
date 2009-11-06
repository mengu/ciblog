<?php

class User extends Model
{
	function User()
	{
		parent::Model();
	}
	
	function find_by_email($email)
	{
		$this->db->where('email', $email);
		$user = $this->db->get('user')->result_array();
		if ($user)
		{
			return $user[0];
		}
		else
		{
			return false;
		}
	}
	
}

?>
