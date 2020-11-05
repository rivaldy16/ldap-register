# SSO Dashboard

# LDAP Initialization
`$ldap = new LdapClient($this->getParameter('ldap_host'), $this->getParameter('base_dn'), $this->getParameter('admin_pass'));`

# LDAP Add
```
$dn_entry = "cn=dewtes2,ou=User,dc=example,dc=org";
$entry_attr = [
    'sn' => [
        'tes'
    ],
    'objectClass' => [
        'inetOrgPerson'
    ],
    'userPassword' => '{MD5}' . base64_encode(pack('H*', md5("password")))
];       
$results = $ldap->add($dn_entry, $entry_attr);
```


# LDAP Add Member to Specific Group
If you want to add user, you also need to add user as a member to specific group

```
$dn_group = "cn=citizen,ou=group,dc=example,dc=org";
$query = "(objectclass=groupOfUniqueNames)"
$user_dn = "cn=dewtes2,ou=User,dc=example,dc=org";

$result = $ldap->addMember($dn_group, $query, $user_dn);
```


# LDAP Get 
`$results = $ldap->get("(objectclass=inetOrgPerson)");`

