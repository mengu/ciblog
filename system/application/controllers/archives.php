<?php

class Archives extends Controller
{
    function Archives()
    {
        parent::Controller();
        $this->load->model('Post');
        $this->postCount = $this->db->count_all('post');
        $this->header = $this->load->view('header', array('postCount' => $this->postCount, 'perPage' => 5), true);
        $this-footer = $this->load->view('footer', false, true);
        $this->data['allTags'] = $this->Post->getAllTags();
        $this->data['recentPosts'] = $this->Post->getLatestEntries(5);
        $this->data['recentComments'] = $this->Post->getLatestComments(5);
        $this->data['blogArchives'] = $this->Post->getArchives();
        $this->data['unapprovedComments'] = $this->Post->getUnapprovedComments(5);
        $this->sidebar = $this->load->view('sidebar', $this->data, true);
    }

    function view()
    {
        $year = $this->uri->segment(3);
        $month = $this->uri->segment(4);
        $day = $this->uri->segment(5);
        $like = $year.($month?"-$month":"").($day?"-$day":"");
        $this->db->like('dateline', $like, 'after');
        $this->db->order_by('post.id', 'desc');
        $this->db->select('slug, title');
        $data['archives'] = $this->db->get('post')->result();
        $data['header'] = $this->header;
        $data['sidebar'] = $this->sidebar;
        $data['footer'] = $this->footer;
        $data['archiveDate'] = $year.($month?"/$month":"").($day?"/$day":"");
        $this->load->view('archives/view', $data);
    }

}

?>
