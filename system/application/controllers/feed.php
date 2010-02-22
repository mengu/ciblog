<?php

class Feed extends Controller
{
    function Feed()
    {
        parent::Controller();
        $this->load->model('Post');
        $this->load->helper('markdown');
    }

    function index()
    {
        $this->db->limit(10);
        $this->db->order_by('id', 'desc');
        $this->db->where('published', 1);
        $data['posts'] = $this->db->get("post")->result();
        $data['title'] = false;
        $this->load->view('feeds/main', $data);
    }

    function tag()
    {
        $tag = $this->uri->segment(2);
		$tagInfo = $this->db->query("SELECT tag FROM relations WHERE tagslug = '$tag'")->result();
		$this->db->join('post', "post.id = relations.postid");
		$this->db->order_by('post.id', 'desc');
		$this->db->limit(10);
		$this->db->where('published', '1');
		$data['posts'] = $this->db->get_where('relations', array('tagslug' => strtolower($tag)))->result();
		$data['title'] = $tagInfo[0]->tag;
        $this->load->view('feeds/main', $data);
    }

}

?>
