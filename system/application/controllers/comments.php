<?php

class Comments extends Controller
{
	function Comments()
	{
		parent::Controller();
		$this->load->model('Post');
		$this->load->helper('markdown');
        $this->postCount = $this->db->count_all('post');
        $this->header = $this->load->view('header', array('postCount' => $this->postCount, 'perPage' => 5), true);
        $this->footer = $this->load->view('footer', false, true);
        $this->data['blogArchives'] = $this->Post->getArchives();
        $this->data['allTags'] = $this->Post->getAllTags();
        $this->data['recentPosts'] = $this->Post->getLatestEntries(10);
        $this->data['recentComments'] = $this->Post->getLatestComments(5);
        $this->data['unapprovedComments'] = $this->Post->getUnapprovedComments(5);
        $this->sidebar = $this->load->view('sidebar', $this->data, true);
	}
	
	function create()
	{
		$_POST['dateline'] = time();
		if (!$this->session->userdata('user'))
		{
			if (!empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['body']))
			{
                $_POST['body'] = htmlspecialchars($_POST['body']);
				if ($this->db->insert('comment', $_POST))
				{
					$commentCount = $this->Post->getCommentCount($_POST['postid']);
					$this->db->update('post', array('commentcount' => $commentCount+1), array('id' => $_POST['postid']));
					$this->session->set_flashdata('commentsaved', 'Thank you for posting comment. Your comment is currently awaiting approval.');
					redirect(base_url()."post/".$this->Post->getField('slug', $_POST['postid'])."#comments");
				}
			}
			else
			{
				$this->postCount = $this->db->count_all('post');
                $data['header'] = $this->header;
                $data['sidebar'] = $this->sidebar;
                $data['footer'] = $this->footer;
                $data['post'] = $this->db->get_where('post', array('id' => $_POST['postid']))->result();
                if ($data['post'])
                {
                    $data['comments'] = $this->db->get_where('comment', array('postid' => $data['post'][0]->id, 'approved' => 'approved'))->result();
                }
				$data['error'] = "Please enter your name, email and response.";
				$this->load->view('post/view', $data);
			}
		}
		else
		{
			$commentCount = $this->Post->getCommentCount($_POST['postid']);
			$user = $this->session->userdata('user');
			$_POST['userid'] = $user['id'];
			$_POST['name'] = $user['name'];
			$_POST['email'] = $user['email'];
			$_POST['approved'] = 'approved';
			if ($this->db->insert('comment', $_POST))
			{
				$this->db->update('post', array('commentcount' => $commentCount+1), array('id' => $_POST['postid']));
				redirect(base_url()."post/".$this->Post->getField('slug', $_POST['postid'])."#comments");
			}
		}
	}
	
	function approve()
	{
	    if (!$this->session->userdata('isAdmin'))
	    {
	        return false;
	    }
	    else
	    {
	        if ($this->db->update('comment', array('approved' => 'approved'), array('id' => $_POST['id'])))
	        {
	            return true;
	        }
	    }
	}
	
	function delete()
	{
	    if (!$this->session->userdata('isAdmin'))
	    {
	        return false;
	    }
	    else
	    {
	        if ($this->db->delete('comment', array('id' => $_POST['id'])))
	        {
	            return true;
	        }
	    }
	}
	
	
}

?>
