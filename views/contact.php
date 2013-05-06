<h1>Contact Form</h1>
<?php echo validation_errors(); ?>
<?

	echo form_open(current_url()); 

?>

<table>
<?php

	echo "<tr>
		<td>" . form_label('Name: ', 'name') . "</td>
		<td>" . form_input('name', set_value('name')) . "</td>
		</tr>";

	echo "<tr>
		<td>" . form_label('Email: ', 'email'). "</td>
		<td>" . form_input('email', set_value('email')) . "</td>
		</tr>";

	echo "<tr>
		<td>".form_label('Message: ', 'message'). "</td>
		<td><textarea name='message'>" . set_value("message") . "</textarea></td>
		</tr>";
	
	echo "<tr>
		<td>".form_submit('submit', 'Submit Message') . "</td>
		</tr>";

?>
</table>

<?
	echo form_close();
?>

