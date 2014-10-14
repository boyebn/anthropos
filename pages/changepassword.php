<?php
	
	if (isset($_POST["change"]))
	{
		// Try to change the password
		if (validate_login($_SESSION["username"], $_POST["oldpassword"]))
		{
			if (changePassword($_SESSION["username"],$_POST['password'], $_POST['password2']))
			{
				echo "Your password has been changed.<br />
				<a href='./index.php'>Return to homepage</a>";
			} else
			{
				echo "Password change failed! Please try again.";
				// Show the change password form
				require("include/changepasswordform.php");
			}
		} else
		{
			echo "Password change failed! Please try again.";
			// Show the change password form
			require("include/changepasswordform.php");
		}
	} else
	{
		// Show the change password form
		require("include/changepasswordform.php");
	}
	
?>