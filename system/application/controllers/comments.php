<?php

class Comments extends Controller
{
	function Comments()
	{
		parent::Controller();
	}
	
	function create()
	{
		if (!empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['body']))
		{
			$_POST['dateline'] = time();
			if ($this->db->insert('comment', $_POST))
			{
				redirect("/posts/view/$_POST[postid]#comments");
			}
		}
	}
	
	
}

?>
