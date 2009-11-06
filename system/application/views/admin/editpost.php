<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{=T.accepted_language or 'en'}}">
<head>
  <title>Mengu.net Administration</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/style.css" />
  <link rel="stylesheet" title="GitHub" type="text/css" href="<?=base_url();?>static/github.css" /> 
  <style>
  td { padding-left: 5px; }
  </style>
</head>
<body>

<h2 style="margin: 0; border: 0; font-size:40pt;"><a href="<?=base_url();?>">Mengu.net</a></h2>
<div>mengu's weblog on web programming.</div>

<table style="margin-top: 20px; background: #BACFE4;" cellpadding="6" cellspacing="1" width="100%">
<tr>
	<td><a href="/ciblog/admin/posts">Posts</a></td>
	<td><a href="/ciblog/admin/comments/">Comments</a></td>
	<td><a href="/ciblog/admin/users">Users</a></td>
	<td><a href="/ciblog/admin/users">Settings</a></td>
</tr>
</table>
<table style="background: #CFD6DE;" cellpadding="6" cellspacing="1" width="100%">
<tr>
	<? foreach ($submenus AS $submenu): ?>
	<td><a href="/ciblog/admin/<?=$submenu['link'];?>"><?=$submenu['text'];?></a></td>
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
		<td>Description:</td>
		<td><?= form_textarea('description', $post[0]->description);?></td>
	</tr>
	<tr>
		<td>Body:</td>
		<td><?= form_textarea('body', $post[0]->body);?></td>
	</tr>
	<tr>
		<td></td>
		<td><?= form_submit('', 'Create Post');?></td>
	</tr>
</table>
<?= form_close(); ?>

</body>
</html>
