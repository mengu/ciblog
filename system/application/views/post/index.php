<?= $header; ?>

<div id="" class="grid_12">
<div style="margin-top: 50px;">
  <?= $sidebar; ?>

  <div id="posts">
    <? foreach ($posts AS $post): ?>
    <? /*Post::updateSlug($post->title, $post->id); */ ?>
      <div class="posttitle"><a href="<?=base_url();?>post/<?=$post->slug;?>"><?=$post->title;?></a></div>
	  <div class="postdate"><?=$post->dateline;?></div>
	  <div class="commentinfo"><a href="<?=base_url();?>post/<?=$post->slug;?>#comments"><?=$post->commentcount;?> Comment<? if(count($post->commentcount) > 1): ?>s<? endif;?></a></div>
      <div class="description"><?=markdown($post->description);?></div>
      <div class="taglist">Tags: <?=Post::getTagList($post->id);?></div>

      <div><a href="<?=base_url();?>post/<?=$post->slug;?>"><img class="more" style="outline: none;" src="static/readmore.png" border="0"></a></div>

      <!--div class="taglist">Tags: </div-->
    <? endforeach; ?>
  </div>

  <div style="clear: both;"></div>
  <div id="more">more</div>

</div>
</div>

<?= $footer; ?>
