<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{=T.accepted_language or 'en'}}">
<head>
  <title>Mengu.net</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<style>
body { font-family: Trebuchet MS; }
#sidebar { float: left; width: 300px; }
#posts { float: left; margin-left: 150px; width: 500px; }
.posttitle { text-transform: uppercase; font-family: Arial; font-weight: bold; font-size: xx-large; width: 350px; }
.posttitle a { text-decoration: none; color: black; }
.postdate, .commentinfo { display: inline; font-size: small;} 
.commentinfo { padding-left: 10px; }
.postcontent, .description { margin-top: 5px; margin-bottom: 50px; }
.postcontent a, .description a { color: #0099CC; }
.boxtitle { text-transform: uppercase; font-size: large; border-bottom: 1px dashed gray; margin-top: 50px; font-family: Sans-serif; }
.boxcontent a { text-decoration: none; color: #006699; }
.boxcontent div { margin: 5px; }
</style>
<body>

<div style="margin-top: 50px;">
  <div id="sidebar">
	
	<div class="boxtitle" style="margin: 0;">Search The Blog</div>
	<div class="boxcontent">
	<form method="post" action="post/search">
	<input type="text" name="query" /> <input type="submit" value="Search" />
	</form>
	</div>
	
	<div class="boxtitle">Recent Posts</div>
	<div class="boxcontent">
	<? foreach ($recentPosts AS $recentPost): ?>
		<div><a href="/post/view/<?=$recentPost->id;?>"><?=$recentPost->title;?></a></div>
	<? endforeach; ?>
	</div>
	
  </div>
  <div id="posts">
    <? foreach ($posts AS $post): ?>
      <div class="posttitle"><a href="/ciblog/posts/view/<?=$post->id;?>"><?=$post->title;?></a></div>
	  <div class="postdate"><?=$post->dateline;?></div>
	  <div class="commentinfo"><?=$post->commentcount;?> Comments</div>
      <div class="description"><?=markdown($post->description);?></div>
    <? endforeach; ?>
  </div>

</div>

</body>
</html>
