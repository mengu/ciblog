<?= $header; ?>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>
  
  <div id="registrationform">
	<? if ($errors): ?>
		<? foreach ($errors AS $error): ?>
			<p><?=$error;?></p>
		<? endforeach; ?>
	<? endif; ?>
	<?= form_open('users/login'); ?>
    <p>E-Mail Address:</p>
    <p><?= form_input('email');?></p>
    <p>Password:</p>
    <p><?= form_password('password');?></p>
    <p><?= form_submit('', 'Sign In');?></p>
    <?= form_close(); ?>
  </div>
  
  <div style="clear: both;"></div>


</div>

<?= $footer; ?>
