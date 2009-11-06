<?= $header; ?>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>
  <div id="posts">
      <div class="posttitle"><?=$post[0]->title;?></div>
	  <div class="postdate"><?=$post[0]->dateline;?></div>
	  <div class="commentinfo"><a href="<?=base_url();?>posts/view/<?=$post[0]->id;?>#comments"><?=Post::getCommentCount($post[0]->id); ?> Comments</a></div>
      <div class="description"><?=markdown($post[0]->body);?></div>
      <div class="taglist">Tags: <?=Post::getTagList($post[0]->id);?></div>
	  
	  <div id="comments">
	  <h2>Comments</h2>
	  <? if (count($comments) > 0): ?>
		  <? $c = 0; ?>
		  <? foreach($comments AS $comment): ?>
			<div class="commentbox">
			<div class="commentauthor"><? if ($comment->website): ?><a href="<?=$comment->website;?>"><?=$comment->name;?></a><? else: ?><?=$comment->name;?><? endif; ?> said on <?=date("d F Y", $comment->dateline);?>:</div>
			<div class="commentbody"><?=$comment->body;?></div>
			</div>
		  <? endforeach; ?>
	   <? else: ?>
			<div>No comments made for this post.</div>
	   <? endif; ?>
	  </div>
	  
	  <br />
	  <h2>Say It Loud</h2>
	  <div id="commentform">
	  <?php
		echo form_open('/comments/create');
		echo form_hidden('postid', $post[0]->id);
	  ?>
	  <? if ($error): ?>
	  <p><?= $error;?></p>
	  <? endif; ?>
	  <? if (!$this->session->userdata('user')): ?>
	  <p>Name Surname:</p>
	  <p><?=form_input('name');?></p>
	  <p>E-Mail Address:</p>
	  <p><?=form_input('email');?></p>
	  <p>Web Site:</p>
	  <p><?=form_input('website');?></p>
	  <? else: ?>
	  <p>You are logged in as <?=$username;?>.</p>
	  <? endif; ?>
	  <p>Comment:</p>
	  <p><?=form_textarea('body');?></p>
	  <p><?=form_submit('', 'Post Comment');?></p>
	  <?= form_close();?>
	  </div>
	  
  </div>
  
  <div style="clear; both;"></div>
  

</div>

</body>
</html>
