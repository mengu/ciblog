<?= $header; ?>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>
  
  <div id="registrationform">
	<?= form_open('users/create'); ?>
    <p>Name Surname:</p>
    <p><?= form_input('name');?></p>
    <p>E-Mail Address:</p>
    <p><?= form_input('email');?></p>
    <p>Password:</p>
    <p><?= form_password('password');?></p>
    <p><?= form_submit('', 'Sign Up');?></p>
    <?= form_close(); ?>
    
  </div>
  
  <div style="clear: both;"></div>


</div>

</body>
</html>
