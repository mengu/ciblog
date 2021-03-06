<?php

class Tags extends Controller
{

	function Tags()
	{
		parent::Controller();
		$this->load->model('Post');
		$this->postCount = $this->db->count_all('post');
		$this->header = $this->load->view('header', array('postCount' => 0, 'perPage' => 0, 'current' => "", 'title' => false, 'keywords' => Post::getAllTags(true)), true);
        $this->footer = $this->load->view('footer', false, true);
		$this->data['blogArchives'] = $this->Post->getArchives();
		$this->data['allTags'] = $this->Post->getAllTags();
		$this->data['recentPosts'] = $this->Post->getLatestEntries(10);
		$this->data['recentComments'] = $this->Post->getLatestComments(5);
		$this->data['unapprovedComments'] = $this->Post->getUnapprovedComments(5);
        $this->data['recentTracks'] = $this->lastfm->getLatestSongs();
		$this->sidebar = $this->load->view('sidebar', $this->data, true);
	}

	function tag()
	{
		$tag = $this->uri->segment(2);
		$tagInfo = $this->db->query("SELECT tag, tagslug FROM relations WHERE tagslug = '$tag'")->result();
		$this->db->join('post', "post.id = relations.postid");
		$this->db->order_by('post.id', 'desc');
		$this->db->where('published', '1');
		$data['posts'] = $this->db->get_where('relations', array('tagslug' => strtolower($tag)))->result();
		$data['header'] = $this->load->view('header', array('title' => $tagInfo[0]->tag, 'description' => $tagInfo[0]->tag, 'keywords' => $tag), true);
		$data['sidebar'] = $this->sidebar;
        $data['footer'] = $this->footer;
		$data['tag'] = $tagInfo[0]->tag;
		$data['tagslug'] = $tagInfo[0]->tagslug;
		$this->load->view('tags/tag', $data);
	}
}

?>
