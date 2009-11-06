<?php

class Comments extends Controller
{
	function Comments()
	{
		parent::Controller();
	}
	
	function create()
	{
		$_POST['dateline'] = time();
		if (!$this->session->userdata('user'))
		{
			if (!empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['body']))
			{
				if ($this->db->insert('comment', $_POST))
				{
					redirect(base_url()."posts/view/$_POST[postid]#comments");
				}
			}
		}
		else
		{
			$user = $this->session->userdata('user');
			$_POST['userid'] = $user['id'];
			$_POST['name'] = $user['name'];
			$_POST['email'] = $user['email'];
			if ($this->db->insert('comment', $_POST))
			{
				redirect(base_url()."posts/view/$_POST[postid]#comments");
			}
		}
	}
	
	
}

?>
