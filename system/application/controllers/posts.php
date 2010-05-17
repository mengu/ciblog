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
        $this->header = $this->load->view('header', array('postCount' => $this->postCount, 'perPage' => 5, 'current' => "", 'title' => false, 'keywords' => Post::getAllTags(true)), true);
        $this->footer = $this->load->view('footer', false, true);
        $this->data['blogArchives'] = $this->Post->getArchives();
        $this->data['allTags'] = $this->Post->getAllTags();
        $this->data['recentPosts'] = $this->Post->getLatestEntries(10);
        $this->data['recentComments'] = $this->Post->getLatestComments(5);
        $this->data['unapprovedComments'] = $this->Post->getUnapprovedComments(5);
        $this->sidebar = $this->load->view('sidebar', $this->data, true);
    }

    function index()
    {
        $data['header'] = $this->load->view('header', array('postCount' => $this->postCount, 'perPage' => 5, 'current' => 'home', 'keywords' => Post::getAllTags(true), 'description' => substr(Post::getAllTags(true), 0, 150), 'title' => false), true);
        $data['sidebar'] = $this->sidebar;
        $data['footer'] = $this->footer;
        $this->db->where('published', '1');
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
        $data['error'] = false;
        $data['sidebar'] = $this->sidebar;
        $data['footer'] = $this->footer;
        $data['post'] = $this->db->get_where('post', array('slug' => $this->uri->segment(2)))->result();
        if ($data['post'])
        {
            $keywords = implode(", ", Post::getPostTagsForKeywords($data['post'][0]->id));
            $data['header'] = $this->load->view('header', array('postCount' => $this->postCount, 'perPage' => 5, 'current' => "", 'title' => $data['post'][0]->title, 'description' => substr($data['post'][0]->title, 0, 150), 'keywords' => $keywords), true);
            $this->db->order_by("comment.dateline", "asc");
            $data['comments'] = $this->db->get_where('comment', array('postid' => $data['post'][0]->id, 'approved' => 'approved'))->result();
        }
        else
        {
            $data['header'] = $this->load->view('header', array('postCount' => $this->postCount, 'perPage' => 5, 'current' => "", 'title' => "Mengu.net - No posts found."), true);
        }
        $this->load->view('post/view', $data);
    }

    function search()
    {
        $search = "SELECT post.id, post.title, post.slug FROM post WHERE (post.body
                          LIKE '%".$this->db->escape_like_str($_POST['query'])."%'
                          OR post.title LIKE '%".$this->db->escape_like_str($_POST['query'])."%')
                          AND post.published = '1'
                          ORDER BY post.id DESC";
        $data['posts'] = $this->db->query($search)->result();
        $data['sidebar'] = $this->sidebar;
        $data['header'] = $this->header;
        $data['footer'] = $this->footer;
        $data['query'] = $_POST['query'];
        $this->load->view('post/search', $data);
    }

    function more()
    {
        $offset = $this->uri->segment(3);
        if (!intval($offset))
        {
                return false;
        }
        $this->db->where('published', '1');
        $this->db->order_by('id', 'DESC');
        $postList = $this->db->get('post', 5, $offset)->result_array();
        foreach ($postList AS $key => $post)
        {
                $postList[$key]['description'] = markdown($postList[$key]['description']);
                $postList[$key]['commentcount'] = $this->Post->getCommentCount($postList[$key]['id']);
                $postList[$key]['taglist'] = $this->Post->getTagList($postList[$key]['id']);
        }
        echo json_encode($postList);
    }

}

?>
