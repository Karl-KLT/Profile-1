<?php

namespace App\Http\Services;

use App\Repositories\AuthRepository;

class AuthService
{
    protected $AuthRepository;
    
    public function __construct(AuthRepository $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
    }

    public function login()
    {
        return $this->AuthRepository->login();
    }

    public function me()
    {
        return $this->AuthRepository->me();
    }
}