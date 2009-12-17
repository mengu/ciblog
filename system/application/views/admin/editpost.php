<?= $header; ?>
<table style="background: #CFD6DE;" cellpadding="6" cellspacing="1" width="100%">
<tr>
	<? foreach ($submenus AS $submenu): ?>
	<td><a href="<?=base_url();?>admin/<?=$submenu['link'];?>"><?=$submenu['text'];?></a></td>
	<? endforeach; ?>
</tr>
</table>
<?= form_open('admin/updatepost'); ?>
<?= form_hidden('id', $post[0]->id); ?>
<table cellpadding="6" cellspacing="1" width="100%">
	<tr>
		<td>Title:</td>
		<td><?= form_input('title', $post[0]->title);?></td>
	</tr>
	<tr>
		<td>Tags:</td>
		<td><?= form_input('tags', $post[0]->tags);?></td>
	</tr>
	<tr>
		<td>Description:</td>
		<td><?= form_textarea('description', $post[0]->description);?></td>
	</tr>
	<tr>
		<td>Body:</td>
		<td><?= form_textarea('body', $post[0]->body);?></td>
	</tr>
  <tr>
	  <td>Preview:</td>
	  <td><?= form_input('preview', $post[0]->preview); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?= form_submit('', 'Create Post');?></td>
	</tr>
</table>
<?= form_close(); ?>

</body>
</html>

