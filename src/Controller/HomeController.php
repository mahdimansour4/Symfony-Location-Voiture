<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController{

    #[Route('/', name: 'home')]
    public function index(Request $request):Response{
        return $this->render('home/index.html.twig', );
    }

    #[Route('/about', name: 'about')]
    public function about(Request $request): Response{
        return $this->render('home/about.html.twig', );
    }

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request): Response{
        return $this->render('home/contact.html.twig', );
    }
}