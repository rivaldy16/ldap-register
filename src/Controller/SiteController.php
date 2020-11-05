<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Lib\LdapClient;

class SiteController extends AbstractController
{

    /**
     *
     * @Route("/", name="landingpage", methods={"GET"})
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }    
    
}

