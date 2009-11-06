<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{=T.accepted_language or 'en'}}">
<head>
  <title>Mengu.net</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/style.css" />
  <link rel="stylesheet" title="GitHub" type="text/css" href="<?=base_url();?>static/github.css" />
  <script src="<?=base_url();?>static/highlight.js"></script>
  <script src="<?=base_url();?>static/highlight.pack.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
  
</head>
<body>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>
  <div id="posts">
      <div class="posttitle"><?=$post[0]->title;?></div>
	  <div class="postdate"><?=$post[0]->dateline;?></div>
	  <div class="commentinfo"><?=$post[0]->commentcount;?> Comments</div>
      <div class="description"><?=markdown($post[0]->body);?></div>
	  
	  <div id="comments">
	  <h2>Comments</h2>
	  <? $c = 0; ?>
	  <? foreach($comments AS $comment): ?>
		<div class="comment">
		<div class="commentauthor"><? if ($comment->website): ?><a href="<?=$comment->website;?>"><?=$comment->name;?></a><? else: ?><?=$comment->name;?><? endif; ?></div>
		<div class="commentbody"><?=$comment->body;?></div>
		</div>
	  <? endforeach; ?>
	  </div>
	  
	  <div id="commentform">
	  <h2>Say It Loud</h2>
	  <?php
		echo form_open('/comments/create');
		echo form_hidden('postid', $post[0]->id);
	  ?>
	  <p>Name Surname:</p>
	  <p><?=form_input('name');?></p>
	  <p>E-Mail Address:</p>
	  <p><?=form_input('email');?></p>
	  <p>Web Site:</p>
	  <p><?=form_input('website');?></p>
	  <p>Comment:</p>
	  <p><?=form_textarea('body');?></p>
	  <p><?=form_submit('', 'Post Comment');?></p>
	  </div>
	  
  </div>
  
  <div style="clear; both;"></div>
  

</div>

</body>
</html>
