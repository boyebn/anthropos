<form action='<?php echo "index.php?p=" . $pages["Change Password"]; ?>' method='post'>
	<fieldset>
	<legend>Change Password</legend>
	<dl>
		<dt>
			<label for='oldpassword'>Current Password:</label>
		</dt>
		<dd>
			<input name='oldpassword' type='password' id='oldpassword'>
		</dd>
	</dl>
	<dl>
		<dt>
			<label for='password'>New Password:</label>
		</dt>
		<dd>
			<input name='password' type='password' id='password'>
		</dd>
	</dl>
	<dl>
		<dt>
			<label for='password2'>Re-type new password:</label>
		</dt>
		<dd>
			<input name='password2' type='password' id='password2'>
		</dd>
	</dl>
		<p>
			<input name='change' type='submit' value='Reset Password'>
		</p>
	</fieldset>
</form>