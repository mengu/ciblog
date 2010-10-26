<?php

class Sitemap extends Controller
{
    function Sitemap()
    {
        parent::Controller();
        $this->load->model('Post');
        header("Content-Type: text/xml");
    }
    
    function index() {
    	$data['lastPostUpdate'] = Post::getLastPostUpdate();
    	$data['lastTagUpdate'] = Post::getLastTagUpdate();
    	$this->load->view('sitemap/index', $data);
    }

    function posts()
    {
        $data['posts'] = Post::getPostsForSitemap();
        $this->load->view('sitemap/posts', $data);
    }

    function tags()
    {
        $data['tags'] = Post::getTagsForSitemap();
        $this->load->view('sitemap/tags', $data);
    }

}

?>
