<?= $header; ?>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>

  <div id="posts">
	<h2 style="font-size: 20px;">Entries Posted in <?=$archiveDate;?></h2>
    <? foreach ($archives AS $archive): ?>
      <div class="tagpost"><a href="<?=base_url();?>post/<?=$archive->slug;?>"><?=$archive->title;?></a></div>
    <? endforeach; ?>
  </div>

  <div style="clear: both;"></div>
  </div>

</div>

</body>
</html>
