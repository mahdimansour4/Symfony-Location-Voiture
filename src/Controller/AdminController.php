<?php

namespace App\Controller;


use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController{

    #[Route('/admin', name: 'admin')]
    public function admin(Request $request,
                          UserRepository $userRepository,
                          ImageRepository $imageRepository):Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $userRepository->findAll();
        $image = $imageRepository->findAll();
        return $this->render('admin/index.html.twig',[
            'users' => $users,
            'images' => $image
        ]);
    }
}