
<script type="text/javascript">
	function searchForm()
	{
		var x = document.forms["search"]["s"].value;
		if (x != null && x != "")
		{
			x = "?s=" + x.replace(" ", "%20");
			window.location.assign(x);
		}
		return false;
	} 
</script>

<form name='search' method='post' onsubmit="return searchForm();" action='index.php'>
<fieldset>
	<legend>Search</legend> 
	<dl> 
		<dt><label title='search'>Search: </label></dt> 
		<dd><input tabindex='1' name='s' type='text'/></dd> 
	</dl> 
	<p><input tabindex='3' type='submit' value='Search' /></p>
</form>

<?php
	if ($search = getSearchTerm())
	{
		$result = freeSearch($search);
	?>
	<table>
		<tr>
			<th>Name</th>
			<th>Username</th>		
			<th>Email</th>
		</tr>
	<?php
		foreach ($result as $person) {
			echo 
			"<tr>
				<td><a href='person.php?uid=" . $person["uid"][0] . "'>" . $person["cn"][0] . "</a></td>
				<td>" . $person["uid"][0] . "</td>
				<td>" . $person["mail"][0] . "</td>
			</tr>";
		}
		echo "</table>";
	}
?>
</fieldset>
