<?= $header; ?>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>
  
  <div id="posts">
	<h2>Posts Tagged With <?=$tag;?></h2>
    <? foreach ($posts AS $post): ?>
      <div class="tagpost"><a href="<?=base_url();?>posts/view/<?=$post->id;?>"><?=$post->title;?></a></div>
    <? endforeach; ?>
  </div>
  
  <div style="clear: both;"></div>  
  </div>

</div>

</body>
</html>
