<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Http\Services\UploaderServices;

class AuthRepository
{

    protected $UploaderServices;

    public function __construct(UploaderServices $UploaderServices)
    {
        $this->UploaderServices = $UploaderServices;
    }

    public function login()
    {
        if (! $token = auth('api')->attempt(request()->only('email','password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function updateOrCreate()
    {
        $validation = Validator::make(request()->all(),[
            'name' => ['required','min:10'],
            'email' => ['required','unique:users,email,'.request()->id,'email']
        ]);

        if($validation->fails()){
            return response()->json(['error'=>$validation->getMessageBag(),'message'=>'validation failed'],500);
        }

        try{
            $user = User::updateOrCreate(['id'=>request()->id],request()->except('password','image'));

            if(request()->password){
                $user->password = Hash::make(request()->password);
            }

            if(request()->hasFile('image')){
                $user->image = $this->UploaderServices->upload(request()->file('image'),'UserProfiles');
            }

            $user->update();


            if(request()->id){
                return response()->json(['status'=>200,'message'=>'account has been updated successfully']);
            }

            return response()->json(['status'=>200,'message'=>'account has been created successfully']);
        }catch(Throwable $e){
            return response()->json(['status'=>500,'message'=>'failed','error'=>$e],500);
        }
    }

    public function me()
    {
        return response()->json(['data'=>auth('api')->user(),'status'=>200,'message'=>'successfully'],200);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'status' => 200,
            'message' => 'successfully'
        ]);
    }
}
