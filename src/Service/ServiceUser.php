<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class ServiceUser
{

    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    function newUser(User $user)
    {
        $this->userRepository->newUser($user);

    }


}