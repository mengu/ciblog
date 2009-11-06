<?php

class Admin extends Controller
{
	function Admin()
	{
		parent::Controller();
		$this->load->model('Post');
		$this->user = $this->session->userdata('user');
		if ($this->user['group'] != 'admin')
		{
			die("You don't have access to this area.");
		}
		$this->subMenus = array(
			'post' => array(
			array('link' => 'newpost', 'text' => 'New Post'),
			array('link' => 'posts', 'text' => 'Manage Posts')
		),);
	}
	
	function index()
	{
		$this->load->view('admin/index');
	}
	
	function posts()
	{
		$data['header'] = $this->load->view('admin/header', false, true);
		$data['submenus'] = $this->subMenus['post'];
		$this->db->order_by('id', 'DESC');
		$data['posts'] = $this->db->get('post')->result();
		$this->load->view('admin/posts', $data);
		
	}
	
	function newpost()
	{
		$data['submenus'] = $this->subMenus['post'];
		$this->load->view('admin/newpost', $data);
	}
	
	function createpost()
	{
		$_POST['dateline'] = date("Y-m-d h:i:s");
		$_POST['commentcount'] = 0;
		$taglist = explode(", ", $_POST['tags']);
		unset($_POST['tags']);
		if ($this->db->insert('post', $_POST))
		{
			$postId = $this->db->insert_id();
			foreach ($taglist AS $tag)
			{
				$relationData['postid'] = $postId;
				$relationData['tag'] = $tag;
				$this->db->insert('relations', $relationData);
			}
			redirect(base_url()."posts/view/".$postId);
		}
	}
	
	function editpost()
	{
		$data['submenus'] = $this->subMenus['post'];
		$this->db->where('id', $this->uri->segment(3));
		$post = $this->db->get('post')->result();
		$tagList = $this->db->get_where('relations', array('postid' => $post[0]->id))->result();
		$postTagList = array();
		foreach ($tagList AS $tag)
		{
			$postTagList[] = $tag->tag;
		}
		$post[0]->tags = implode(", ", $postTagList);
		$data['post'] = $post;
		$this->load->view('admin/editpost', $data);
	}
	
	function updatepost()
	{
		$tagList = explode(", ", $_POST['tags']);
		unset($_POST['tags']);
		if ($this->db->update('post', $_POST, array('id' => $_POST['id'])))
		{
			$postTagList = $this->Post->getPostTags($_POST['id']);
			foreach ($tagList AS $tag)
			{
				// if post doesn't have this tag, save it.
				if (!$this->Post->postHasTag($_POST['id'], $tag))
				{
					$this->Post->saveTag($_POST['id'], $tag);
				}
			}
			foreach ($postTagList AS $postTag)
			{
				// if tag in database isn't posted, delete it.
				if (!in_array($postTag, $tagList))
				{
					$this->Post->deleteTag($_POST['id'], $postTag);
				}
			}
			redirect(base_url()."posts/view/".$_POST['id']);
		}
	}
	
	function deleteposts()
	{
		if (!empty($_POST['delete']))
		{
			foreach ($_POST['delete'] AS $postid)
			{
				$this->db->delete('post', array('id' => $postid));
			}
			redirect(base_url()."admin");
		}
	}
	
	function comments()
	{
		$data['header'] = $this->load->view('admin/header', false, true);
		$data['comments'] = $this->db->query("SELECT * FROM comment ORDER BY id DESC")->result();
		$this->load->view('admin/comments', $data);
	}
	
	function unapprovecomment()
	{
		if ($this->db->update('comment', array('approved' => 'unapproved'), array('id' => $this->uri->segment(3))))
		{
			redirect(base_url()."admin/comments");
		}
	}
	
	function approvecomment()
	{
		if ($this->db->update('comment', array('approved' => 'approved'), array('id' => $this->uri->segment(3))))
		{
			redirect(base_url()."admin/comments");
		}
	}
	
	function deletecomment()
	{
		if ($this->db->delete('comment', array('id' => $this->uri->segment(3))))
		{
			redirect(base_url()."admin/comments");
		}
	}
	
}

?>
