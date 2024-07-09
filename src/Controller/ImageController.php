<?php

namespace App\Controller;


use App\Entity\Image;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ImageController extends AbstractController{
    #[Route('/image_create', name: 'image.create')]
    public function createImage(Request $request,
                                FileUploaderService $fileUploader,
                                EntityManagerInterface $em): Response{
        if($request->getMethod() == 'POST'){
            $image = new Image();
            $file = $request->files->get('image');
            if($file){
                $fileName = $fileUploader->upload($file);
                $image->setImagePath($fileName);
            }
            $image->setCreatedAt(new \DateTimeImmutable('now'));
            $em->persist($image);
            $em->flush();
            return $this->redirectToRoute('image.list');
        }

        return $this->render('image/create.html.twig');
    }

    #[Route('/image_list', name: 'image.list')]
    public function ImageList(EntityManagerInterface $em): Response{
        $images = $em->getRepository(Image::class)->findAll();
        return $this->render('image/index.html.twig', [
            'images' => $images,
        ]);
    }

}