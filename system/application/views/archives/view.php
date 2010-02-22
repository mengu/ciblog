<?= $header; ?>

<div class="page">
    <div class="line">
        <div class="unit size2of3">
            <div id="posts">
            <div class="post">
            <h2 style="font-size: 20px;">Entries Posted in <?=$archiveDate;?></h2>
            <ul>
            <? foreach ($archives AS $archive): ?>
              <li class="tagpost"><a href="<?=base_url();?>post/<?=$archive->slug;?>"><?=$archive->title;?></a></li>
            <? endforeach; ?>
            </ul>
            </div>
            </div>
        </div>
<?= $sidebar; ?>
    </div>
</div>

<?= $footer; ?>
