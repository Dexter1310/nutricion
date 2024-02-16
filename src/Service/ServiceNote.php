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


    function newNote(Note $note,User $user)
    {
        $this->noteRepository->newNote($note,$user);

    }

    function getNotesList($user):array
    {
        return $this->noteRepository->getNotesList($user);

    }

    function deleteNote($id):string
    {
        return $this->noteRepository->deleteNote($id);

    }


}