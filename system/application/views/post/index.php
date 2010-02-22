<?= $header; ?>

<div class="page">
    <div class="line">
        <div class="unit size2of3">

            <div id="posts">
            <? foreach ($posts AS $post): ?>
                <div class="post">
                    <h1 class="post-title"><a href="<?=base_url();?>post/<?=$post->slug;?>"><?=$post->title;?></a></h1>
                    <div class="post-info"><?=$post->dateline;?> | <a href="<?=base_url();?>post/<?=$post->slug;?>#comments"><?=$post->commentcount;?> Comment<? if($post->commentcount > 1): ?>s<? endif;?></a></div>
                    <div class="post-body"><?=markdown($post->description);?></div>
                    <div class="tag-list">Tags: <?=Post::getTagList($post->id);?></div>
                </div>
            <? endforeach; ?>
            </div>
            <div id="more">more</div>
        </div>
<?= $sidebar; ?>
    </div>
</div>


<?= $footer; ?>
