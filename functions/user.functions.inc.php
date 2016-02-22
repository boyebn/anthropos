<?php

    ##### User Functions #####

    function changePassword($username, $newpassword, $newpassword2)
    {
        global $connection, $DN;

        if ($newpassword != $newpassword2)
        {
            return false;
        }

        $search = ldap_search($connection, $DN, "(uid=" . $username . ")", array("dn"));
        $ent = ldap_get_entries($connection, $search);
        if ($ent["count"] == 0)
        {
            return false;
        }
        $user_dn = $ent[0]['dn'];
        $new = array();
        $new['userPassword'] = $newpassword;
        if(ldap_modify($connection, $user_dn, $new))
        {
            return true;
        } else
        {
            return false;
        }

    }

    function registerNewUser($username, $password, $firstname, $lastname, $email, $phone, $groups)
    {
        global $connection, $DN;

        $info = array();
        $info["uid"] = $username;
        $info["userPassword"] = $password;
        $info["givenName"] = $firstname;
        $info["sn"] = $lastname;
        $info["cn"] = $firstname . $lastname;
        $info["mail"] = $email;
        $info["telephoneNumber"] = $phone;
        $info["objectClass"][0] = "top";
        $info["objectClass"][1] = "person";
        $info["objectClass"][2] = "organizationalPerson";
        $info["objectClass"][3] = "inetorgperson";
        $info["objectClass"][4] = "posixAccount";
        $info["objectClass"][5] = "inetuser";

        if (ldap_add($connection, $DN, $info) == false)
        {
            return false;
        }

        foreach ($groups as $group)
        {
            addUserToGroup($username, $group);
        }

        return true;
    }

    function addUserToGroup($username, $group)
    {
        global $connection, $DN;
        $search = ldap_search($connection, $DN, "(uid=" . $username . ")", array("dn"));
        $ent = ldap_get_entries($connection, $search);
        if ($ent["count"] == 0)
        {
            return false;
        }
        $user_dn = $ent[0]['dn'];
        $member = array();
        $member["uniquemember"] = $user_dn;

        return ldap_mod_add($connection, $group, $member);

    }

    function removeUserFromGroup($username, $group)
    {
        global $connection, $DN;
        $search = ldap_search($connection, $DN, "(uid=" . $username . ")", array("dn"));
        $ent = ldap_get_entries($connection, $search);
        if ($ent["count"] == 0)
        {
            return false;
        }
        $user_dn = $ent[0]['dn'];
        $member = array();
        $member["uniquemember"] = $user_dn;

        return ldap_mod_del($connection, $group, $member);
    }

    function lostPassword($username, $email)
    {
        $randomPassword = generate_code(10);
        if (changePassword($username, $randomPassword, $randomPassword))
        {
            if (sendLostPasswordEmail($username, $email, $randomPassword))
            {
                return true;
            }
        }

        return false;
    }

    function generate_code($length = 10)
    {
        if ($length <= 0)
        {
            return false;
        }

        $code = "";
        $chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
        srand((double)microtime() * 1000000);
        for ($i = 0; $i < $length; $i++)
        {
            $code = $code . substr($chars, rand() % strlen($chars), 1);
        }
        return $code;
    }

    function getGoups($g){
        $groups = array();

        $groups["comitees"] = array();
        $groups["rights"] = array();
        $groups["sections"] = array();
        $groups["positions"] = array();

        foreach ($g as $value)
        {
            if ($i = strpos($value, "comitees"))
            {
                // $n = strpos($)
            } else if ($i = strpos($value, "comitees"))
            {
                // do stuff
            } else if ($i = strpos($value, "comitees"))
            {
                // do stuff
            } else if ($i = strpos($value, "comitees"))
            {
                // do stuff
            } else
            {
                // do stuff
            }
        }

    }

?>
