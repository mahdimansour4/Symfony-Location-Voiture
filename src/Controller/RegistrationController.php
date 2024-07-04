<?php

namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class RegistrationController extends AbstractController{
    #[Route('/register', name: 'register')]
    public function registerUser(Request $request,
                                 EntityManagerInterface $em,
                                 UserPasswordHasherInterface $hasher):Response{
        if($request->isMethod('POST')){
            $user = new User();
            $user->setEmail($request->request->get('email'));
            $user->setUsername($request->request->get('username'));
            $user->setTelephone($request->request->get('telephone'));
            $user->setCIN($request->request->get('cin'));
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($hasher->hashPassword($user,$request->request->get('password')));
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/register.html.twig');
    }
}