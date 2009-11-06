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
		$this->postCount = $this->db->count_all('post');
		$this->header = $this->load->view('header', array('postCount' => $this->postCount, 'perPage' => 5), true);
		$this->data['allTags'] = $this->Post->getAllTags();
		$this->data['recentPosts'] = $this->Post->getLatestEntries(5);
		$this->data['recentComments'] = $this->Post->getLatestComments(5);
		$this->sidebar = $this->load->view('sidebar', $this->data, true);
    }

    function index()
    {
		$data['header'] = $this->header;
		$data['sidebar'] = $this->sidebar;
		$this->db->order_by('id', 'DESC');
        $data['posts'] = $this->db->get('post', 5)->result();
        $this->load->view('post/index', $data);
    }
    
    function view()
    {
		if ($this->session->userdata('user'))
		{
			$user = $this->session->userdata('user');
			$data['username'] = $user['name'];
		}
		$data['header'] = $this->header;
		$data['error'] = false;
		$data['sidebar'] = $this->sidebar;
		$data['post'] = $this->db->get_where('post', array('id' => $this->uri->segment(3)))->result();
		$data['comments'] = $this->db->get_where('comment', array('postid' => $this->uri->segment(3), 'approved' => 'approved'))->result();
		$this->load->view('post/view', $data);
    }
    
    function search()
    {
		$search = "SELECT post.id, post.title FROM post WHERE post.body 
				  LIKE '%".$this->db->escape_like_str($_POST['query'])."%' 
				  OR post.title LIKE '%".$this->db->escape_like_str($_POST['query'])."%'";
		$data['posts'] = $this->db->query($search)->result();
		$data['sidebar'] = $this->sidebar;
		$data['header'] = $this->header;
		$this->load->view('post/search', $data);
	}
	
	function more()
	{
		$offset = $this->uri->segment(3);
		if (!intval($offset))
		{
			return false;
		}
		$this->db->order_by('id', 'DESC');
		$postList = $this->db->get('post', 5, $offset)->result_array();
		foreach ($postList AS $key => $post)
		{
			$postList[$key]['taglist'] = $this->Post->getTagList($postList[$key]['id']);
		}
		echo json_encode($postList);
	}

}

?>
