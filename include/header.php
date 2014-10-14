<?php
	// No errors
	error_reporting(0);
	// Starting session
	session_start();

	require_once("settings/ldap_connect.inc.php");
	require_once("functions/functions.inc.php");
	require_once("settings/menu.inc.php");
	
?>

<!DOCKTYPE HTML>
<html>
<head>
<title>Anthropos</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>