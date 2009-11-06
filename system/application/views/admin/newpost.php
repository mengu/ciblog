<?= $header; ?>
<table style="background: #CFD6DE;" cellpadding="6" cellspacing="1" width="100%">
<tr>
	<? foreach ($submenus AS $submenu): ?>
	<td><a href="<?=base_url();?>admin/<?=$submenu['link'];?>"><?=$submenu['text'];?></a></td>
	<? endforeach; ?>
</tr>
</table>
<?= form_open('admin/createpost'); ?>
<table cellpadding="6" cellspacing="1" width="100%">
	<tr>
		<td>Title:</td>
		<td><?= form_input('title');?></td>
	</tr>
	<tr>
		<td>Tags:</td>
		<td><?= form_input('tags');?></td>
	</tr>
	<tr>
		<td>Description:</td>
		<td><?= form_textarea('description');?></td>
	</tr>
	<tr>
		<td>Body:</td>
		<td><?= form_textarea('body');?></td>
	</tr>
	<tr>
		<td></td>
		<td><?= form_submit('', 'Create Post');?></td>
	</tr>
</table>
<?= form_close(); ?>

</body>
</html>
