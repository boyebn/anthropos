<?php
	
	require_once("include/header.php");
	
	if (isLoggedIn())
	{
		// User is logged in
		
		require_once("include/navbar.php");
		
		require("pages/home.php");
		
	} else
	{
		// User is not logged in
		
		if (isset($_POST["cmdlogin"]))
		{
			// Retrive the username and password sent from login form & check the login
			if (checkLogin($_POST["username"], $_POST["password"]))
			{
				require_once("include/navbar.php");
				require("pages/home.php");
			} else
			{
				echo "Incorrect Login information.";
				require("include/loginform.php");
			}
		} else
		{
			// The user is not logged in and has not pressed the login button
			require("include/loginform.php");
		}
		
	}
	
	require_once("include/footer.php");
	
?>