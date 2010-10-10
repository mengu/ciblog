<?= $header; ?>

<table id="subtable" style="background: #31C3E7;" cellpadding="6" cellspacing="1" width="100%">
<tr style="background: #6D8CA0; color: #fff;">
<td>Name Surname</td>
<td>Email</td>
<td>Message</td>
<td>Date</td>
</tr>
<? foreach ($contacts AS $contact): ?>
	<tr valign="top">
		<td><?=$contact->name;?></td>
		<td><?=$contact->email;?></td>
		<td width="40%"><?=nl2br($contact->message);?></td>
		<td><?=$contact->dateline;?></td>
	</tr>
<? endforeach; ?>
</table>

</body>
</html>
