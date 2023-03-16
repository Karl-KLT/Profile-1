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
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        return response()->json($this->AuthService->login(),200);
    }

    public function me()
    {
        return response()->json(['data'=>$this->AuthService->me(),'status'=>200,'message'=>'successfully'],200);
    }
}
