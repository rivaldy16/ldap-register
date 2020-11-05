<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Lib\LdapClient;
use Symfony\Component\Ldap\Ldap;
use Symfony\Component\Ldap\Adapter\AdapterInterface;


/**
 * @Route("/verification")
 */

class UserVerificationController extends AbstractController
{
	/**
     * @Route("/", name="user_verification", methods={"GET"})
     */
    
    public function view(UserRepository $userRepository): Response
    {
    	$user = $this->getDoctrine()->getRepository('App:User')->findAll();
    

        return $this->render('user_verification/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}", name="user_detail", methods={"GET"})
     */
    public function detail(User $user): Response
    {
        return $this->render('user_verification/detail.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/accept", name="user_accept", methods={"GET"})
     */

    public function accept(User $user)
    {	
    	$repo = $this->getDoctrine()
	      ->getRepository(User::class)
	      ->find($user);

    	$cn = $repo->getNamaDepan().'.'.$repo->getNamaBelakang();
    	$displayName = $repo->getNamaDepan().' '.$repo->getNamaBelakang();
    	$givenName = $repo->getNamaDepan();
        $email = $repo->getEmail();
        $sn = $repo->getNamaBelakang();
        $password =  $repo->getPassword();

        $ldap = new LdapClient($this->getParameter('ldap_host'), $this->getParameter('base_dn'), $this->getParameter('admin_pass'));

		//print_r($email);exit(); 

        $dn_entry = "cn=".$cn.",ou=User,dc=example,dc=org";

		$entry_attr = [
		    'sn' => [$sn],
		    'displayName' => [$displayName],
		    'givenName' => [$givenName],
            'mail' => [$email],
		    'objectClass' => ['inetOrgPerson'],
		    'userPassword' => '{MD5}' . base64_encode(pack('H*', md5($password)))
		];

		$results = $ldap->add($dn_entry, $entry_attr);
		//print_r($results);exit(); 

		//return $results;
        return $this->render('user_verification/detail.html.twig', [
             'user' => $user,
        ]);
    }

    public function reject(User $user)
    {
        return $this->render('user_verification/index.html.twig', [
             'user' => $user,
        ]);
    }
}