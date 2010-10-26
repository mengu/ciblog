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
        $this->db->where('published', '1');
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
			$postTags[$tag->id] = $tag->tagslug;
		}
		return $postTags;
	}
    
    function getPostTagsForKeywords($postId)
	{
		$this->db->where('postid', $postId);
		$tagList = $this->db->get('relations')->result();
		$postTags = array();
		foreach ($tagList AS $tag)
		{
			$postTags[$tag->id] = strtolower($tag->tag);
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

	function deleteAllTags($postId)
	{
	    $this->db->delete('relations', array('postid' => $postId));
	}

	function getAllTags($noanchor = false)
	{
		$sql = "SELECT DISTINCT(tagslug), tag FROM relations 
                JOIN post ON (relations.postid = post.id)
                WHERE post.published = '1'
                ORDER BY relations.id DESC";
		$tagList = $this->db->query($sql)->result();
		$allTags = array();
		foreach ($tagList AS $tag)
		{
		    if ($noanchor)
	        {
	            $allTags[] = strtolower($tag->tag);
	        }
	        else
	        {
	            $allTags[] = anchor("/tag/".$tag->tagslug."", $tag->tag, 'class="tag"');
	        }
		}
		return implode(", ", $allTags);
	}

	function getArchives()
	{
	    $archives = $this->db->query("
                    SELECT DISTINCT DATE_FORMAT(dateline, '%M %Y') AS display, 
                    DATE_FORMAT(dateline, '%Y/%m') AS link 
                    FROM post 
                    WHERE published = '1'
                    ORDER BY link DESC")->result();
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
	
	function getPostsForSitemap() {
	    $postQuery = "
        	SELECT p.slug, DATE_FORMAT(p.dateline, '%Y-%m-%d') AS dateline, 
        	FROM_UNIXTIME((SELECT c.dateline FROM comment AS c
        		WHERE c.postid = p.id AND c.approved = 'approved'
        		ORDER BY c.id DESC
        		LIMIT 1), '%Y-%m-%d') AS last_updated
        	FROM post AS p
        	WHERE p.published = '1'
        	ORDER BY p.id DESC
        ";
        return $this->db->query($postQuery)->result();   
	}
	
	function getTagsForSitemap() {
	    $tagQuery = "
        	SELECT DISTINCT(tagslug), 
        		DATE_FORMAT((SELECT dateline FROM post AS p WHERE p.id = t.postid ORDER BY p.id DESC), '%Y-%m-%d') AS last_updated 
        	FROM relations AS t
        ";
        return $this->db->query($tagQuery)->result();
	}
	
	function getLastPostUpdate() {
		$lastPostUpdateQuery = "
			SELECT DATE_FORMAT(p.dateline, '%Y-%m-%d') AS dateline, 
				FROM_UNIXTIME((SELECT c.dateline FROM comment AS c
				WHERE c.postid = p.id
				ORDER BY id DESC
				LIMIT 1), '%Y-%m-%d') AS last_updated
			FROM post AS p
			ORDER BY p.id DESC
			LIMIT 1
		";
		$result = $this->db->query($lastPostUpdateQuery)->result();
		return $result[0]->last_updated === null ? $result[0]->dateline : $result[0]->last_updated;
	}
	
	function getLastTagUpdate() {
		$lastTagUpdateQuery = "
			SELECT t.id,
				DATE_FORMAT((SELECT p.dateline FROM post AS p
				WHERE t.postid = p.id
				ORDER BY id DESC
				LIMIT 1), '%Y-%m-%d') as last_updated
			FROM relations AS t
			ORDER BY t.id DESC
			LIMIT 1
		";
		$result = $this->db->query($lastTagUpdateQuery)->result();
		return $result[0]->last_updated;
	}
	
	
	

}
?>
