<?= $header; ?>

<?= form_open('admin/deletecomments');?>
<table style="background: #31C3E7;" cellpadding="6" cellspacing="1" width="100%">
<tr style="background: #6D8CA0; color: #fff;">
<td>Operations</td>
<td>Name Surname</td>
<td>Email</td>
<td>Comment</td>
<td>Post</td>
</tr>
<? foreach ($comments AS $comment): ?>
	<tr>
		<td>
		<? if ($comment->approved == 'approved'): ?>
		<a href="<?=base_url();?>admin/unapprovecomment/<?=$comment->id;?>/">Unapprove</a>
		<? else: ?>
		<a href="<?=base_url();?>admin/approvecomment/<?=$comment->id;?>/">Approve</a>
		<? endif; ?>
		<a href="<?=base_url();?>admin/deletecomment/<?=$comment->id;?>">Delete</a>
		</td>
		<td><?=$comment->name;?></td>
		<td><?=$comment->email;?></td>
		<td><?=$comment->body;?></td>
		<td><?=Post::printField('title', $comment->postid);?></td>
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
