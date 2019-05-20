<?php

namespace App;

use Illuminate\Support\Facades\Hash;

class AisLogin
{

    public function login($user, $pass)
    {

        // Set default LDAT configuration, username, password to login to LDAP
        $ldap_dn = "ou=People,dc=stuba,dc=sk";
        $ldaprdn = 'uid='.$user.',ou=People,dc=stuba,dc=sk';

        // Connect to LDAP
        $ldapconn = ldap_connect('ldap://ldap.stuba.sk');

        // Set LDAP protocol version
        $set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        // If connection was success, we can continue
        if($ldapconn) {

            // Try to login to LDAP -> If login to LDAP was successful we can user data from LDAP
            if (@ldap_bind($ldapconn, $ldaprdn, $pass))
            {
                // Search for my user
                $sr = ldap_search($ldapconn, $ldap_dn, "uid=".$user, array("givenname","employeetype","surname","mail","faculty","cn","uisid","uid"));
                $users_array = ldap_get_entries($ldapconn, $sr);
                $my_user = $users_array[0];

                // Set userdata in session to work with userdata easier
                $result = [
                    'success' => true,
                    'data' => [
                        'name' => $my_user['givenname'][0].' '.$my_user['sn'][0],
                        'email' => $my_user['uid'][0], // to email save username
                        'ais_id' => $my_user['uisid'][0], // to email save username
                        //'email' => $my_user['mail'][2],
                        'password' => Hash::make($pass),
                    ]
                ];

            }
            else
            {
                // Set status message -> Unsuccessfull login (wrong user/pass)
                $result = ['success' => false, 'msg' => ldap_error($ldapconn)];
            }

            // Close connection by LDAP
            ldap_unbind($ldapconn);

        }
        else
        {
            $result = ['success' => false, 'msg' => ldap_error($ldapconn)];
        }

        // Return array with data to register
        return $result;
    }
}