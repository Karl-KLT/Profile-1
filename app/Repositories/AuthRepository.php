<?php

namespace App\Repositories;

use App\Events\sendVerifyCodeEvent;
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
        $validation = Validator::make(request()->all(),[
            'email' => ['required','email','regex:/.*@(gmail).com/'],
            'password' => ['required']
        ],[
            'email.regex' => 'The email field format is invalid, email must be (@gmail).'
        ]);


        if($validation->fails()){
            return response()->json(['error'=>$validation->getMessageBag(),'message'=>'validation failed'],500);
        }

        if (! $token = auth('api')->attempt(request()->only('email','password'))) {
            return response()->json(['error'=>['Auth'=>['Unauthorized, check ur email and password']]], 401);
        }

        return $this->respondWithToken($token);
    }

    public function updateOrCreate()
    {
        $validation = Validator::make(request()->all(),[
            'name' => ['required','min:10'],
            'email' => ['required_unless:id,'.request()->id,'unique:users,email,'.request()->id,'email','regex:/.*@(gmail).com/']
        ],[
            'email.regex' => 'The email field format is invalid, email must be (@gmail).'
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
            return response()->json(['status'=>500,'message'=>'failed'],500);
        }
    }

    public function sendVerifyCode()
    {
        $validation = Validator::make(request()->all(),[
            'email' => ['required','email','regex:/.*@(gmail).com/']
        ]);

        if($validation->fails()){
            return response()->json(['error'=>$validation->getMessageBag(),'message'=>'validation failed'],500);
        }


        return response()->json(event(new sendVerifyCodeEvent(request()->email))[0]);
    }

    public function checkVerifyCode()
    {
        $validation = Validator::make(request()->all(),[
            'email' => ['required','email','regex:/.*@(gmail).com/'],
            'code' => ['required']
        ]);

        if($validation->fails()){
            return response()->json(['error'=>$validation->getMessageBag(),'message'=>'validation failed'],500);
        }

        try{
            $User = User::where('email',request()->email)->first() ?: null;

            if(!$User){
                return response()->json(['status'=>200,'message'=>'account has not found']);
            }

            if(request()->code == $User->email_active_code){
                $User->email_active_code = null;
                $User->email_verified_at = now();
                $User->update();
                return response()->json(['status'=>200,'message'=>'account has been verified']);
            }

            return response()->json(['status'=>500,'message'=>'something went wrong with code, try again'],500);

        }catch(Throwable $e){
            return $e;
        }
    }


    public function me()
    {
        return response()->json(['data'=>auth('api')->user(),'status'=>200,'message'=>'successfully'],200);
    }

    public function visit()
    {
        $validation = Validator::make(request()->all(),[
            'user_code' => 'numeric',
        ]);

        if($validation->fails()){
            return response()->json(['error'=>$validation->getMessageBag(),'message'=>'validation failed'],500);
        }

        return response()->json([
            'status'=>200,
            'message'=>'successfully',
            'User'=>User::all()->where('user_code',request()->user_code)->first()
        ],200);
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
