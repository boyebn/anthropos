<?php
	
	session_start();
	
	if (isset($_SESSION["username"]))
	{
		unset($_SESSION["username"]);
	}
	if (isset($_SESSION["access"]))
	{
		unset($_SESSION["access"]);
	}
	
	session_destroy();
	
	header("Location: index.php");
	
?>