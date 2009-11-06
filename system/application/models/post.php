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
			$postTags[] = anchor("/tags/".strtolower($tag->tag)."", $tag->tag);
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
			$postTags[] = $tag->tag;
		}
		return $postTags;
	}
	
	function postHasTag($postId, $tag)
	{
		$this->db->where('postid', $postId);
		$this->db->where('tag', $tag);
		$this->db->from('relations');
		$count = $this->db->count_all_results();
		return $count > 0 ? true : false;
	}
	
	function saveTag($postId, $tag)
	{
		$this->db->insert('relations', array('postid' => $postId, 'tag' => $tag));
	}
	
	function deleteTag($postId, $tag)
	{
		$this->db->delete('relations', array('postid' => $postId, 'tag' => $tag));
	}
	
	function getAllTags()
	{
		$sql = "SELECT DISTINCT(tag) FROM relations";
		$tagList = $this->db->query($sql)->result();
		$allTags = array();
		foreach ($tagList AS $tag)
		{
			$allTags[] = anchor("/tags/".strtolower($tag->tag)."", $tag->tag);
		}
		return implode(", ", $allTags);
	}
	
	function getArchives()
	{
	}
	
	function getCommentCount($postId)
	{
		$this->db->where('postid', $postId);
		$this->db->from('comment');
		return $this->db->count_all_results();
	}
    
    function printField($field, $postId)
    {
		$this->db->select($field)->from('post')->where('id', $postId);
		$result = $this->db->get()->result();
		echo $result[0]->$field;
	}
    
}
?>
