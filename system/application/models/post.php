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
class Post extends Model
{
	function Post()
	{
		parent::Model();
	}

	function getLatestEntries($limit)
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get('post', $limit)->result();
	}

	function getLatestComments($limit)
	{
		$this->db->where('approved', 'approved');
		$this->db->order_by('comment.id', 'DESC');
		return $this->db->get('comment', $limit, 0, 'post')->result();
	}

	function getTagList($postId)
	{
		$this->db->where('postid', $postId);
		$tagList = $this->db->get('relations')->result();
		$postTags = array();
		foreach ($tagList AS $tag)
		{
			$postTags[] = anchor("/tag/".$tag->tagslug."", $tag->tag);
		}
		return implode(", ", $postTags);
	}

	function getPostTags($postId)
	{
		$this->db->where('postid', $postId);
		$tagList = $this->db->get('relations')->result();
		$postTags = array();
		foreach ($tagList AS $tag)
		{
			$postTags[] = $tag->tagslug;
		}
		return $postTags;
	}

	function postHasTag($postId, $tagslug)
	{
		$this->db->where('postid', $postId);
		$this->db->where('tagslug', $tagslug);
		$this->db->from('relations');
		$count = $this->db->count_all_results();
		return $count > 0 ? true : false;
	}

	function saveTag($postId, $tag, $tagslug)
	{
		$this->db->insert('relations', array('postid' => $postId, 'tag' => $tag, 'tagslug' => $tagslug));
	}

	function deleteTag($postId, $tagslug)
	{
		$this->db->delete('relations', array('postid' => $postId, 'tagslug' => $tagslug));
	}

	function getAllTags()
	{
		$sql = "SELECT DISTINCT(tagslug), tag FROM relations";
		$tagList = $this->db->query($sql)->result();
		$allTags = array();
		foreach ($tagList AS $tag)
		{
			$allTags[] = anchor("/tag/".$tag->tagslug."", $tag->tag);
		}
		return implode(", ", $allTags);
	}

	function getArchives()
	{
	    $archives = $this->db->query("SELECT DISTINCT DATE_FORMAT(dateline, '%M %Y') AS display, DATE_FORMAT(dateline, '%Y/%m') AS link FROM post ORDER BY link DESC")->result();
	    $blogArchives = array();
	    foreach ($archives AS $archive)
	    {
	        $blogArchives[] = array('link' => $archive->link, 'display' => $archive->display);
	    }
	    return $blogArchives;
	}

	function getUnapprovedComments($limit)
	{
	    $this->db->where('approved', 'unapproved');
	    return $this->db->get('comment', $limit)->result();
	}

	function getCommentCount($postId)
	{
		$this->db->where('postid', $postId);
		$this->db->where('approved', 'approved');
		$this->db->from('comment');
		return $this->db->count_all_results();
	}

    function getField($field, $postId)
    {
		$this->db->select($field)->from('post')->where('id', $postId);
		$result = $this->db->get()->result();
		return $result[0]->$field;
	}

    function makeTitleReadable($title)
    {
		$trChars = array("ç", "ı", "ğ", "ş", "ö", "ü");
		$replaceChars = array("c", "i", "g", "s", "o", "u");
		$title = str_replace($trChars, $replaceChars, $title);
		preg_match_all('/[^\sA-Za-z-0-9]/i', $title, $matches);
		foreach ($matches[0] AS $char)
		{
		    $title = str_replace("$char", "", $title);
		}
		$title = str_replace(" ", "-", strtolower($title));
		//$specialChars = array("-", " ", "'", "'", "$", ".");
		//$replaceSpecialChars = array("", "-", "", "", "s", "");
		//$title = str_replace($specialChars, $replaceSpecialChars, strtolower($title));
		return $title;
	}

	function deletePostTags($postid)
	{
		$this->db->delete('relations', array('postid' => $postid));
	}

	function updateSlug($title, $postid)
	{
	    $this->db->update('post', array('slug' => Post::makeTitleReadable($title)), array('id' => $postid));
	}

}
?>
