<?= $header; ?>
<table style="background: #CFD6DE;" cellpadding="6" cellspacing="1" width="100%">
<tr>
	<? foreach ($submenus AS $submenu): ?>
	<td><a href="<?=base_url();?>admin/<?=$submenu['link'];?>"><?=$submenu['text'];?></a></td>
	<? endforeach; ?>
</tr>
</table>

<?= form_open('admin/deleteposts');?>
<table cellpadding="6" cellspacing="1" width="100%">
<tr>
<td>Post Title</td>
<td>Delete Post</td>
</tr>
<? foreach ($posts AS $post): ?>
	<tr>
		<td><a href="<?=base_url();?>admin/editpost/<?=$post->id;?>"><?=$post->title; ?></a></td>
		<td><input type="checkbox" name="delete[]" value="<?=$post->id;?>">Delete</td>
	</tr>
<? endforeach; ?>
<tr>
<td><?= form_submit('', 'Delete Selected Posts'); ?></td>
<td></td>
</tr>
</table>
<?= form_close(); ?>

</body>
</html>
