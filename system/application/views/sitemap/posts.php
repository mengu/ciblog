<?= "<?xml version='1.0' encoding='UTF-8'?>" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<url>
		<loc>http://www.mengu.net/</loc>
		<lastmod><?= $posts[0]->dateline ?></lastmod>
		<changefreq>always</changefreq>
		<priority>1.0</priority>
	</url>
	
	<? foreach ($posts AS $post): ?>
	<url>
		<loc>http://www.mengu.net/post/<?= $post->slug ?></loc>
		<lastmod><?= $post->last_updated === null ? $post->dateline : $post->last_updated ?></lastmod>
		<changefreq>daily</changefreq>
	</url>
	<? endforeach; ?>
	
</urlset>