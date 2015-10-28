<?php
	
	##### Login Functions #####
	
	function isLoggedIn()
	{
		if (isset($_SESSION["username"]))
		{
			// The user is logged in
			return true;
		} else
		{
			// The user is not logged in
			return false;
		}
		// Just for safety
		return false;
	}
	
	function checkLogin($user, $password)
	{
		global $HOST, $PORT, $DN;
		// Make a new connection to the LDAP server for validating the user
		$user_connect = ldap_connect($HOST,$PORT);
		// Try to bind to the LDAP server with the username and password the user entered
		if($user_bind = @ldap_bind($user_connect, "uid=" . $user . "," . $DN, $password))
		{
			// Successfull bind
			
			// Get the groups the user is a member of
			$filter = "(uid=" . $user . ")";
			$attr = array("memberOf");
			$result = ldap_search($user_connect, $DN, $filter, $attr) or die($connection_error_message);
			$entries = ldap_get_entries($user_connect, $result);
			ldap_unbind($user_connect);
			
			// Determen the access (higher number => more access)
			$access = -1; // No access
			
			// Check the groups for access
			foreach($entries[0]['memberof'] as $grps)
			{
				// Is admin, break loop
				if (strpos($grps, "it-drift")) { $access = 2; break; }
				// Is manager
                if (strpos($grps, "funk")) $access = 1;
                // give esso access
                if ($user == "esso") { $access = 2; }
				// Is user
				if (strpos($grps, "active") && ($access < 0)) $access = 0;
			}
			
			if ($access >= 0)
			{
				// Access granted
				// Establish session variables
				if ($access < 2)
				{
					return false; // temporary only allow IT-Drift
				}
				$_SESSION['username'] = $user;
				$_SESSION['access'] = $access;
				return true;
			} else
			{
				// Access denied
				return false;
			}

		} else
		{
			// Invalid username or password
			return false;
		}
		// Just for safety
		return false;
	}
	
?>
