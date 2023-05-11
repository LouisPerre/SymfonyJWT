<?php
namespace App\Service;

use Symfony\Component\Ldap\Adapter\ExtLdap\Adapter;
use Symfony\Component\Ldap\Entry;
use Symfony\Component\Ldap\Exception\ConnectionException;
use Symfony\Component\Ldap\Exception\LdapException;
use Symfony\Component\Ldap\Ldap;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class ActiveDirectory
{
    public function __construct(
    private Adapter $ldapAdapter,
    private string $ldapServiceDn,
    private string $ldapServiceUser,
    private string $ldapServicePassword,
    private Ldap $ldap,
    ) {
        $this->ldap = new Ldap($this->ldapAdapter);
        $this->ldap->bind(implode(',', [$ldapServiceUser, $ldapServiceDn]), $ldapServicePassword);
    }

    // Récupère un utilisateur AD via le LDAP à partir des informations envoyées
    public function getEntryFromActiveDirectory(string $username, string $password): ?Entry
    {
        $ldap = new Ldap($this->ldapAdapter);
        $search = false;
        $value = null;

        try {
            $search = $this->ldap->query(
                'dc=louislocal,dc=com',
                '(&(objectclass=person)(cn='. $username .'))'
            )->execute();

            if (1 !== count($search)) {
                throw new BadCredentialsException('Could not find user or query matched more than 1 user');
            }

            $entry = $search[0];
            $ldap->bind($entry->getDn(), $password);
        } catch (ConnectionException $exception) {
            throw new BadCredentialsException('Bad Password');
        } catch (LdapException $exception) {
            throw new BadCredentialsException('Bad query');
        }

        if ($search && 1 === count($search)) {
            $value = $search[0];
        }
        return $value;

//        try {
////            dd($username, $this->ldapServiceDn, $password);
////            dd(implode(',', ['cn='.$username, $this->ldapServiceDn]));
//            $ldap->bind(implode(',', ['cn='.$username, $this->ldapServiceDn]), $password);
//            dd($ldap);
//            if ($this->ldapAdapter->getConnection()->isBound()) {
//                $search = $ldap->query(
//                    'cn=Louis Perrenot,dc=louislocal,dc=com',
//                    '(&(objectclass=person))'
//                )->execute()->toArray();
//                dd($search);
//            }
//        } catch (ConnectionException) {
//            return null;
//        }
//        if ($search && 1 === count($search)) {
//            $value = $search[0];
//        }
//        return $value;
    }
}
