<?php

namespace App\Controller\Admin;

use App\Entity\Note;
use App\Form\NoteType;
use App\Service\ServiceNote;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class NoteController extends AbstractController
{
    public function __construct(
       private ServiceNote $serviceNote
    )
    {
    }

    #[Route('/notes', name: 'notes')]
    public function notesAction(Request $request): Response
    {
        $note= new Note();
        $form = $this->createForm(NoteType::class,$note);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash(
                'success',
                'Nota registrada'
            );
            $this->serviceNote->newNote($note);
            return $this->redirectToRoute('notes');
        }

        return $this->render('admin/Notes/notes.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/notes_list', name: 'notes_list')]
    public function notesListAction(Request $request): Response
    {

        $list=$this->serviceNote->getNotesList($this->getUser());
        return $this->render('admin/Notes/list_notes.html.twig', [
            'list'=>$list

        ]);
    }







}
