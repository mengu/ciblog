<?php

function getRecentTracks()
{
	$xml = simplexml_load_file('http://ws.audioscrobbler.com/1.0/user/mengukagan/recenttracks.rss');
	$recentTracks = array();
	foreach ($xml->channel->item AS $item)
	{
		$recentTracks[] = array('track' => (string)$item->title);
	}
	return $recentTracks;
}

?>
