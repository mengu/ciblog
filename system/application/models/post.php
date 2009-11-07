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
			$postTags[] = anchor("/tags/".$tag->tagslug."", $tag->tag);
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
			$allTags[] = anchor("/tags/".$tag->tagslug."", $tag->tag);
		}
		return implode(", ", $allTags);
	}
	
	function getArchives()
	{
	}
	
	function getCommentCount($postId)
	{
		$this->db->where('postid', $postId);
		$this->db->where('approved', 'approved');
		$this->db->from('comment');
		return $this->db->count_all_results();
	}
    
    function printField($field, $postId)
    {
		$this->db->select($field)->from('post')->where('id', $postId);
		$result = $this->db->get()->result();
		echo $result[0]->$field;
	}
    
    function makeTitleReadable($title)
    {
		$trChars = array("ç", "ı", "ğ", "ş", "ö", "ü");
		$replaceChars = array("c", "i", "g", "s", "o", "u");
		$title = str_replace($trChars, $replaceChars, $title);
		$title = str_replace(" ", "-", strtolower($title));
		preg_match_all('/[-A-Z0-9]+/i', $title, $newTitle);
		return $newTitle[0][0];
	}
	
	function deletePostTags($postid)
	{
		$this->db->delete('relations', array('postid' => $postid));
	}
    
}
?>
