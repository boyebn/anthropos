<?php
	
	require_once("settings/ldap_settings.inc.php");
	
	$connection = ldap_connect($HOST, $PORT) or die($CONNECTION_ERROR_MESSAGE);
	
	ldap_bind($connection, $LDAPUSER, $PASSWORD) or die($CONNECTION_ERROR_MESSAGE);
	
?>