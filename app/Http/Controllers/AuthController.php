<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
        $this->middleware('auth:api', ['except' => ['login','updateOrCreate']]);
    }

    public function login()
    {
        return $this->AuthService->login();
    }

    public function updateOrCreate()
    {
        return $this->AuthService->updateOrCreate();
    }

    public function me()
    {
        return $this->AuthService->me();
    }
}
