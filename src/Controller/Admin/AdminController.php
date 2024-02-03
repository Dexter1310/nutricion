<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/users', name: 'users')]
    public function usersAction(UserRepository $userRepository): Response
    {
        $users= $userRepository->findAll();
        return $this->render('admin/users.html.twig', [
            'users' => $users,

        ]);
    }

    #[Route('/documents', name: 'documents')]
    public function documentsAction(): Response
    {
        return $this->render('admin/documents.html.twig', [
            'documents' => 'DOCUEMENTOS DE LA ADMINISTRACIÖN ',

        ]);
    }




}
