<?php
namespace App\Lib;

use Symfony\Component\Ldap\Ldap;
use Symfony\Component\Ldap\Entry;
use Symfony\Component\Ldap\Adapter\AdapterInterface;

class LdapClient
{

    private $ldap;

    private $base_dn;

    public function __construct($host, $dn, $password)
    {
        $this->ldap = Ldap::create('ext_ldap', [
            'connection_string' => $host
        ]);
        $this->base_dn = $dn;
        $this->ldap->bind('cn=admin,' . $this->base_dn, $password);
    }

    public function get($query)
    {
        $query = $this->ldap->query($this->base_dn, $query);

        try {
            $results = $query->execute()->toArray();
        } catch (\Exception $e) {
            return false;
        }
        return $results;
    }

     public function add($dn, $attribute)
    {
        //print_r($attribute);exit();
        $entry = new Entry($dn, $attribute);
        $entryManager = $this->ldap->getEntryManager();

        try {
            $entryManager->add($entry);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public function edit($dn, $query, $attribute, $value)
    {
        $query = $this->ldap->query($dn, $query);
        $result = $query->execute();
        $entry = $result[0];

        $entryManager = $this->ldap->getEntryManager();
        $entry->setAttribute($attribute, $value);

        try {
            $entryManager->update($entry);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public function addMember($dn, $query, $value)
    {
        $query = $this->ldap->query($dn, $query);
        $result = $query->execute();
        $entry = $result[0];
        $entryManager = $this->ldap->getEntryManager();

        try {
            $entryManager->addAttributeValues($entry, 'uniqueMember', [
                $value
            ]);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    public function delete($dn)
    {
        $entryManager = $this->ldap->getEntryManager();
        try {
            $entryManager->remove(new Entry($dn));
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}

