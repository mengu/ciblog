<? echo '<?xml version="1.0"?>'; ?>
<rss version="2.0">
   <channel>
      <title>Mengu.net <? if ($title) { echo "- $title"; } ?></title>
      <link>http://www.mengu.net/</link>
      <description>mengu on web programming.</description>
      <language>en-us</language>
      <pubDate><?= date("D, d M Y h:i:s A O"); ?></pubDate>

      <lastBuildDate>Tue, 10 Jun 2003 09:41:01 GMT</lastBuildDate>
      <generator>Mengu.net</generator>
      <managingEditor>mengu@mengu.net</managingEditor>
      <webMaster>mengu@mengu.net</webMaster>

      <? foreach ($posts AS $post): ?>
      <item>
         <title><?= $post->title; ?></title>
         <link>http://www.mengu.net/post/<?= $post->slug; ?></link>
         <description><![CDATA[<?= markdown($post->description); ?>]]></description>
         <pubDate><?= $post->dateline; ?></pubDate>
         <guid>http://www.mengu.net/post/<?= $post->slug; ?></guid>
      </item>
      <? endforeach; ?>
    </channel>
</rss>
