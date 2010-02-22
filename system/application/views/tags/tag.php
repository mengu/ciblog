<?= $header; ?>

<div class="page">
    <div class="line">
        <div class="unit size2of3">
            <div id="posts">
            <div class="post">
            <h2>Posts Tagged With <?=$tag;?> <a href="http://www.mengu.net/feed/<?=$tagslug;?>"><img src="<?=base_url();?>static/rss.png" style="outline: none; vertical-align: middle;" border="0" /></a></h2>
            <ul>
            <? foreach ($posts AS $post): ?>
              <li class="tagpost"><a href="<?=base_url();?>post/<?=$post->slug;?>"><?=$post->title;?></a></li>
            <? endforeach; ?>
            </ul>
            </div>
            </div>
        </div>
<?= $sidebar; ?>
    </div>
</div>

<?= $footer; ?>
