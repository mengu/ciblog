<?php

class Comments extends Controller
{
	function Comments()
	{
		parent::Controller();
		$this->load->model('Post');
		$this->load->helper('markdown');
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
			else
			{
				$this->postCount = $this->db->count_all('post');
				$data['header'] = $this->load->view('header', array('postCount' => 0, 'perPage' => 0), true);
				$this->data['allTags'] = $this->Post->getAllTags();
				$this->data['recentPosts'] = $this->Post->getLatestEntries(5);
				$this->data['recentComments'] = $this->Post->getLatestComments(5);
				$data['post'] = $this->db->get_where('post', array('id' => $_POST['postid']))->result();
				$data['comments'] = $this->db->get_where('comment', array('postid' => $_POST['postid'], 'approved' => 'approved'))->result();
				$data['sidebar'] = $this->load->view('sidebar', $this->data, true);
				$data['error'] = "Please enter your name, email and comment.";
				$this->load->view('post/view', $data);
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
