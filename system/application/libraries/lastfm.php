<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lastfm {

    function getLatestSongs()
    {
        $latestSongsList = array();
        $rssContent = file_get_contents("http://ws.audioscrobbler.com/1.0/user/mengukagan/recenttracks.rss");
        $latestSongs = new SimpleXMLElement($rssContent);
        foreach($latestSongs->channel->item AS $latestSong) {
            $latestSongsList[] = array(
                'title' => $latestSong->title,
                'link'  => $latestSong->link
            );
        }
        return $latestSongsList;
    }
}

?>
