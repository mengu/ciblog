<?= $header; ?>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>
  
  <div id="posts">
    <? foreach ($posts AS $post): ?>
      <div class="tagpost"><a href="/ciblog/posts/view/<?=$post->id;?>"><?=$post->title;?></a></div>
    <? endforeach; ?>
  </div>
  
  <div style="clear: both;"></div>  
  </div>

</div>

</body>
</html>
