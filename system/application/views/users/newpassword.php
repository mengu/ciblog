<?= $header; ?>

<div style="margin-top: 50px;">
  <?= $sidebar; ?>
  
  <div id="registrationform">
	<?= form_open('users/changepassword'); ?>
    <p>Current Password:</p>
    <p><?= form_password('password');?></p>
    <p>New Password:</p>
    <p><?= form_password('newpassword');?></p>
    <p><?= form_submit('', 'Change Password');?></p>
    <?= form_close(); ?>
    
  </div>
  
  <div style="clear: both;"></div>


</div>

</body>
</html>
