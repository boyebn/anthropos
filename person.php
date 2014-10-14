<?php
	
	require_once("include/header.php");
	
	if (isLoggedIn())
	{
		// User is logged in
		
		require_once("include/navbar.php");
		require("pages/person.php");
		
	} else
	{
		// User is not logged in
		require("include/loginform.php");
		
	}
	
	require_once("include/footer.php");
	
?>