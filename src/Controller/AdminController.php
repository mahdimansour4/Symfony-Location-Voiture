<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController{

    #[Route('/admin', name: 'admin')]
    public function admin(Request $request,UserRepository $repository):Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $repository->findAll();
        return $this->render('admin/index.html.twig',[
            'users' => $users,
        ]);
    }
}