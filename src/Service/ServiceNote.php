<?php

namespace App\Service;

use App\Entity\Note;
use App\Entity\User;
use App\Repository\NoteRepository;


class ServiceNote
{
    private NoteRepository $userRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }


    function newNote(Note $note)
    {
        $this->noteRepository->newNote($note);

    }

    function getNotesList($user):array
    {
        return $this->noteRepository->getNotesList($user);

    }


}