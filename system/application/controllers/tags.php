<?php

class Tags extends Controller
{

	function Tags()
	{
		parent::Controller();
		$this->load->model('Post');
		$this->postCount = $this->db->count_all('post');
		$this->header = $this->load->view('header', array('postCount' => 0, 'perPage' => 0), true);
		$this->data['allTags'] = $this->Post->getAllTags();
		$this->data['recentPosts'] = $this->Post->getLatestEntries(5);
		$this->data['recentComments'] = $this->Post->getLatestComments(5);
		$this->sidebar = $this->load->view('sidebar', $this->data, true);
	}
	
	function tag()
	{
		$tag = $this->uri->segment(3);
		$tagInfo = $this->db->query("SELECT tag FROM relations WHERE tagslug = '$tag'")->result();
		$this->db->join('post', "post.id = relations.postid");
		$data['posts'] = $this->db->get_where('relations', array('tagslug' => strtolower($tag)))->result();
		$data['header'] = $this->header;
		$data['sidebar'] = $this->sidebar;
		$data['tag'] = $tagInfo[0]->tag;
		$this->load->view('tags/tag', $data);
	}

}

?>
