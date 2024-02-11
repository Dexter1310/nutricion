<?php

namespace App\Controller\Client;

use App\Entity\User;
use App\Form\UserType;
use App\Service\ServiceUser;
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
    public function newUserAction(Request $request,ServiceUser $serviceUser): Response
    {
        $user= new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash(
                'success',
                'Usuario registrado'
            );

            $serviceUser->newUser($user);
            return $this->redirectToRoute('new_user');
        }

        return $this->render('client/new_user.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
