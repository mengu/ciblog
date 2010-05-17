<?= $header; ?>

<div class="page">
    <div class="line">
        <div class="unit size2of3">
        
             <div class="page">
                <form method="post" action="/pages/sendmessage">
                <p>
                    Name Surname:<br />
                    <input type="text" name="name" />
                </p>
                <p>
                    E-Mail Address:<br />
                    <input type="text" name="email" />
                </p>
                <p>
                    Message:<br />
                    <textarea name="message" rows="10" cols="50"></textarea>
                </p>
                <p>
                    <input type="submit" value="Send Message" style="width: 110px;" />
                </p>
                </form>
              </div>
        </div>
<?= $sidebar; ?>
    </div>
</div>

<?= $footer; ?>
