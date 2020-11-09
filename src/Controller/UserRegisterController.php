<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Form\UserType;

class UserRegisterController extends AbstractController
{

    /**
     * @Route("/register", name="user_register")
     */

    public function register(Request $request, UserPasswordEncoderInterface $password_encoder)
    {
        $user = new User;

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted( )&& $form->isValid()){ 
            $entityManager = $this->getDoctrine()->getManager();

            $user->setNik($request->request->get('user')['nik']);
            $password = $password_encoder->encodePassword($user, $request->request->get('user')['password']['first']);
            $user->setPassword($password);
            $user->setNamaDepan($request->request->get('user')['nama_depan']);
            $user->setNamaBelakang($request->request->get('user')['nama_belakang']);
            $user->setEmail($request->request->get('user')['email']);
            //$user->setRoles(array($role));
            $file = $request->files->get('user')['ktp'];
            $uploadsDir = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()).'.'. $file->guessExtension();
            $file->move(
                $uploadsDir,
                $filename
            );
            //print_r("../../public/uploads/".$filename);exit();
            $user->setKtp($filename);
            $entityManager->persist($user);
            $entityManager->flush();

        }

        return $this->render('user_register/index.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/", name="landingpage", methods={"GET"})
     */

    public function home()
    {
        return $this->render('index.html.twig');
    }
}
