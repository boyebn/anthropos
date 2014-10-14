<?php

	##### LDAP Functions #####

	function search($filter, $return)
	{
		global $connection, $DN;
		
		$search = ldap_search($connection, $DN, $filter, $return);

		$result = ldap_get_entries($connection, $search);

		if ($result["count"] == 0)
		{
			return array();
		}

		return array_slice($result, 1);

	}
	

	function freeSearch($s)
	{
		global $connection, $DN;

		$filter = "(|(uid=*$s*)(cn=*$s*)(mail=*$s*)(telephoneNumber=*$s*))";
		
		return search($filter, array("uid","cn","mail"));
	}


	function getPerson($uid)
	{
		global $connection, $DN;

		$filter = "(uid=$uid)";

		return search($filter, array("uid","cn","mail","telephoneNumber","memberOf"));

	}

?>