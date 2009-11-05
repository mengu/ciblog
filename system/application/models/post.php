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
		return $this->db->get('post', $limit)->result();
	}
	
	function getLatestComments($limit)
	{
		return $this->db->get('post', $limit)->result();
	}
	
	function getArchives()
	{
	}
    //put your code here
}
?>
