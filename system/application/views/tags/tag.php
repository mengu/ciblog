<?= $header; ?>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>

  <div id="posts">
	<h2 style="font-size: 20px;">Posts Tagged With <?=$tag;?></h2>
    <? foreach ($posts AS $post): ?>
      <div class="tagpost"><a href="<?=base_url();?>post/<?=$post->slug;?>"><?=$post->title;?></a></div>
    <? endforeach; ?>
  </div>

  <div style="clear: both;"></div>
  </div>

</div>

</body>
</html>
