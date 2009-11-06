<?= $header ;?>

<div style="margin-top: 50px;">

<?= $sidebar; ?>

<div id="posts">
  <? if (count($posts) > 0): ?>
	<h3><?= count($posts); ?> Results Found.</h3>
	<? foreach ($posts AS $post): ?>
	  <div class="result"><a href="<?=base_url();?>posts/view/<?=$post->id;?>"><?= $post->title; ?></a></div>
	<? endforeach; ?>
  <? else: ?>
	<h2>No posts found.</h2>
  <? endif; ?>
</div>

</div>

</body>
</html>
