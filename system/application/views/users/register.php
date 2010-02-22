<?= $header; ?>

<div class="page">
    <div class="line">
        <div class="unit size2of3">
        
             <div class="registration-form">
                <? if ($errors): ?>
                    <? foreach ($errors AS $error): ?>
                        <p><?=$error;?></p>
                    <? endforeach; ?>
                <? endif; ?>
                <?= form_open('users/create'); ?>
                <p>Name Surname:</p>
                <p><input class="input" type="text" name="name" /></p>
                <p>E-Mail Address:</p>
                <p><input class="input" type="text" name="email" /></p>
                <p>Password:</p>
                <p><input class="input" type="password" name="password" /></p>
                <p><input type="submit" name="Sign Up" /></p>
                <?= form_close(); ?>                
              </div>
        </div>
<?= $sidebar; ?>
    </div>
</div>
