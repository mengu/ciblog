<?= $header; ?>

<div class="page">
    <div class="line">
        <div class="unit size2of3">
        
             <div class="registration-form">
                <?= form_open('users/changepassword'); ?>
                <p>Current Password:</p>
                <p><input class="input" type="password" name="password" /></p>
                <p>New Password:</p>
                <p><input class="input" type="password" name="password" /></p>
                <p><input type="submit" value="Change Password" /></p>
                <?= form_close(); ?>
              </div>
        </div>
<?= $sidebar; ?>
    </div>
</div>
