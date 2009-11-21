<?= $header; ?>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>
  <div id="posts">
	<? if (count($post) > 0): ?>
      <div class="posttitle"><?=$post[0]->title;?></div>
	  <div class="postdate"><?=$post[0]->dateline;?></div>
	  <div class="commentinfo"><a href="<?=base_url();?>post/<?=$post[0]->slug;?>#comments"><?= $post[0]->commentcount; ?> Comment<? if(count($post[0]->commentcount) > 1): ?>s<? endif;?></a></div>
      <div class="description"><?=Markdown($post[0]->body);?></div>

      <? if ($post[0]->preview): ?>
      <div id="preview">
        <h2>Preview</h2>
        <div style="font-size: 12px">The file is located <a href="http://www.mengu.net/repo/<?=$post[0]->preview?>">here</a>.</div>
        <iframe src ="http://www.mengu.net/repo/<?= $post[0]->preview ?>" width="100%" height="150">
        <p>Your browser does not support iframes.</p>
        </iframe>
      </div>
      <? endif; ?>

      <div class="taglist">Tags: <?=Post::getTagList($post[0]->id);?></div>
	  <div id="comments">
	  <h2>Comments</h2>
	  <? if (count($comments) > 0): ?>
		  <? $c = 0; ?>
		  <? foreach($comments AS $comment): ?>
		  <div class="commentbox">
        <?= $comment->body;?>
      </div>
      <div class="commentfooter">Posted by <?= $comment->name; ?> on <?= date("d/m/Y H:i A", $comment->dateline); ?></div>
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
	  <? if ($this->session->flashdata('commentsaved')): ?>
	  <p><?= $this->session->flashdata('commentsaved'); ?></p>
	  <? endif; ?>
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
	  <? else: ?>
		<div class="posttitle">No post found.</div>
	<? endif; ?>
  </div>

  <div style="clear; both;"></div>


</div>

</body>
</html>

