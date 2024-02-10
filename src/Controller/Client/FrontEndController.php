<?php

namespace App\Controller\Client;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontEndController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'FrontEndController',
        ]);
    }

    #[Route(path: '/registrer', name: 'new_user')]
    public function newUserAction(Request $request): Response
    {

        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('new_user');
        }
        return $this->render('client/new_user.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
