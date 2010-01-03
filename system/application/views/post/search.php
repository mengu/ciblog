<?= $header ;?>
<div id="" class="grid_12">
<div style="margin-top: 50px;">

<?= $sidebar; ?>

<div id="posts">
  <? if (count($posts) > 0): ?>
	<h2 style=""><?= count($posts); ?> Results Found.</h2>
	<? foreach ($posts AS $post): ?>
	  <div class="tagpost"><a href="<?=base_url();?>posts/view/<?=$post->id;?>"><?= $post->title; ?></a></div>
	<? endforeach; ?>
  <? else: ?>
	<h2>No posts found.</h2>
  <? endif; ?>
</div>

</div>
</div>
</body>
</html>
