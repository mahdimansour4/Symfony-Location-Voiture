<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\ProfileRepository;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly RoleRepository $roleRepository
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function admin(Request $request, ImageRepository $imageRepository): Response
    {
        $user = $this->userRepository->findUserByEmailOrUsername($this->getUser()->getUserIdentifier());
        $id = $user->getProfileid()->getId();

        if ($role = $this->roleRepository->getRole($id, 'MMA2')) {
            $allusers = $this->userRepository->findAll();
            $normalusers = $this->roleRepository->getUsersByRole('US232');
            $admins = $this->roleRepository->getUsersByRole('MMA2');

            return $this->render('admin/index.html.twig', [
                'users' => $normalusers,
                'admins' => $admins,
                'isAdmin' => true,
            ]);
        } else {
            return $this->redirectToRoute('home', [], Response::HTTP_BAD_REQUEST);
        }
    }
}