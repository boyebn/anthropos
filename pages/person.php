<fieldset>

<?php
	
	require_once("include/header.php");

	if(isLoggedIn())
	{
		if ($uid = getPersonUID())
		{
			$person = getPerson($uid)[0];
			echo "<legend>" . $person["cn"][0] . "</legend>";
			echo "<div class='info'>";
			echo "<table style='width:100%'><tr><td>";

			if (isset($_GET["reset"]) && $_GET["reset"] == "true")
			{
				$tmpPass = generate_code(10);
				if (changePassword($uid, $tmpPass, $tmpPass))
				{
					echo "<b>Changed password to:</b> $tmpPass<br />";
				} else
				{
					echo "Could not change password.<br />";
				}
			} else if (isset($_GET["active"]) && $_GET["active"] == "true")
			{
				$activate = 1;
				foreach ($person["memberof"] as $group)
                                {
                                        if (strpos($group, "active"))
                                        {
                                                $activate = 0;
                                        }
                                }
				if ($activate == 1 && addUserToGroup($uid, "cn=active,ou=sections,ou=org,ou=groups,dc=studentmediene,dc=no"))
				{
					echo $person["cn"][0] . " is now active.<br />";
				} else
				{
					echo "Could not change to active.<br />";
				}
			}

			if (sizeof($person) > 0)
			{

				echo "<br />";
				echo "Name: ";
				echo $person["cn"][0];
				echo "<br />";
				echo "<br />";
				echo "Username: ";
				echo $person["uid"][0];
				echo "<br />";
				echo "<br />";
				echo "Email: ";
				echo $person["mail"][0];
				echo "<br />";
				echo "<br />";
				echo "Phone: ";
				echo $person["telephonenumber"][0];
				echo "<br />";
				echo "<br />";
				
				echo "Status: ";
				$active = 0;
				$gpr = "";
				foreach ($person["memberof"] as $group)
				{
					if (!is_numeric($group))
					{
						$g = substr($group, 3);
						$g = substr($g, 0, strpos($g, ","));
						$gpr = $gpr . $g . "<br />";
					}
					if (strpos($group, "active"))
					{
						$active = 1;
					}
				}
				if ($active == 1)
				{
					echo "Active";
				} else
				{
					echo "Inactive";
				}
				echo "<br /><br />";
				echo "</td><td>Groups:<br /><br />" . $gpr . "</td></tr></table>";
				echo "</div>";

				?>
				<form>
                                <input type=button
                                value="Reset Password"
                                onClick="self.location='?uid=<?php echo $uid; ?>&reset=true'">
                                </form>

				<form>
                                <input type=button
                                value="Set Active"
                                onClick="self.location='?uid=<?php echo $uid; ?>&active=true'"
				<?php if($active == 1) { echo " disabled"; } ?>/>
                                </form>
				<?php
				
			}
		}
	}

	require_once("include/footer.php");

?>

</fieldset>
