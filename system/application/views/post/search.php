<?= $header; ?>

<div class="page">
    <div class="line">
        <div class="unit size2of3">
            <div id="posts">
            <div class="post">
              <? if (count($posts) > 0): ?>
                <h2><? if (strlen($query) == 0): ?>Listing All Posts <? else: ?><?= count($posts); ?> Results Found.<? endif; ?></h2>
                <ul>
                <? foreach ($posts AS $post): ?>
                  <li class="tagpost"><a href="<?=base_url();?>post/<?=$post->slug;?>"><?= $post->title; ?></a></li>
                <? endforeach; ?>
                </ul>
              <? else: ?>
                <h2>Sorry, couldn't find any post.</h2>
              <? endif; ?>
            </div>
            </div>
        </div>
<?= $sidebar; ?>
    </div>
</div>

<?= $footer; ?>
