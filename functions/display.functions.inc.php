<?php
	
	##### Display Functions #####

	function getSearchTerm()
	{
		if (isset($_GET["s"]))
		{
			return htmlspecialchars($_GET["s"]);
		}
		
		return null;
	}

	function getPersonUID()
	{
		if (isset($_GET["uid"]))
		{
			return htmlspecialchars($_GET["uid"]);
		}
		
		return null;
	}
	
?>