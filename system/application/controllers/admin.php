<?php

class Admin extends Controller
{
	function Admin()
	{
		parent::Controller();
		$this->user = $this->session->userdata('user');
		if ($this->user['group'] != 'admin')
		{
			die("You don't have access to this area.");
		}
		$this->subMenus = array(
			'post' => array(
			array('link' => 'newpost', 'text' => 'New Post'),
			array('link' => 'manageposts', 'text' => 'Manage Posts')
		),);
	}
	
	function index()
	{
		$this->load->view('admin/index');
	}
	
	function posts()
	{
		$data['submenus'] = $this->subMenus['post'];
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
		if ($this->db->insert('post', $_POST))
		{
			redirect("/ciblog/posts/view/".$this->db->insert_id());
		}
	}
	
	function editpost()
	{
		$data['submenus'] = $this->subMenus['post'];
		$this->db->where('id', $this->uri->segment(3));
		$data['post'] = $this->db->get('post')->result();
		$this->load->view('admin/editpost', $data);
	}
	
	function updatepost()
	{
		if ($this->db->update('post', $_POST, array('id' => $_POST['id'])))
		{
			redirect("/ciblog/posts/view/".$_POST['id']);
		}
	}
	
}

?>
