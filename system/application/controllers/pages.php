<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pages
 *
 * @author mengu
 */
class Pages extends Controller
{
    function Pages()
    {
        parent::Controller();
        $this->load->model('Post');
        $this->load->helper('markdown');
        $this->postCount = $this->db->count_all('post');
        $this->footer = $this->load->view('footer', false, true);
        $this->data['blogArchives'] = $this->Post->getArchives();
        $this->data['allTags'] = $this->Post->getAllTags();
        $this->data['recentPosts'] = $this->Post->getLatestEntries(5);
        $this->data['recentComments'] = $this->Post->getLatestComments(5);
        $this->data['unapprovedComments'] = $this->Post->getUnapprovedComments(5);
        $this->sidebar = $this->load->view('sidebar', $this->data, true);
    }

    function view()
    {
        $data['header'] = $this->load->view('header', array('postCount' => $this->postCount, 'perPage' => 5, 'current' => $this->uri->segment(2), 'title' => "Mengu.net - ".ucfirst($this->uri->segment(2))."", 'keywords' => Post::getAllTags(true)), true);
        $data['sidebar'] = $this->sidebar;
        $data['footer'] = $this->footer;
        $this->load->view('pages/'.$this->uri->segment(2).'', $data);
    }


}

?>
