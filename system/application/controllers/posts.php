<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of post
 *
 * @author mengu
 */
class Posts extends Controller
{
    function Posts()
    {
        parent::Controller();
		$this->load->model('Post');
		$this->load->helper('markdown');
		$this->recentPosts = $this->Post->getLatestEntries(5);
		$this->recentComments = $this->Post->getLatestComments(5);
		$this->load->scaffolding('post');
		$this->load->scaffolding('comment');
    }

    function index()
    {
		$data['recentPosts'] = $this->recentPosts;
        $data['posts'] = $this->db->get('post')->result();
        $this->load->view('post/index', $data);
    }
    
    function view()
    {
		$sidebar['recentComments'] = $this->recentComments;
		$sidebar['recentPosts'] = $this->recentPosts;
		$data['sidebar'] = $this->load->view('sidebar', $sidebar, true);
		$data['post'] = $this->db->get_where('post', array('id' => $this->uri->segment(3)))->result();
		$data['comments'] = $this->db->get_where('comment', array('postid' => $this->uri->segment(3)))->result();
		$this->load->view('post/view', $data);
    }

}

?>
