<?php

namespace App\Repositories\Clients;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Throwable;

class SkillsRepository
{
    public function getList()
    {
        return User::find(auth('api')->user()->id)->skills;
    }

    public function updateOrCreate()
    {
        $validation = Validator::make(request()->all(),[
            'name'=>'required|unique:skills,name,'.request()->id,
            'count' => 'required|max:100|numeric'
        ]);

        if($validation->fails()){
            return response()->json(['message'=>'validate error','error'=>$validation->getMessageBag()]);
        }

        try{
            User::find(auth('api')->user()->id)->skills()->updateOrCreate(['id'=>request()->id],request()->all());

            if(request()->id){
                return response()->json(['message'=>'skill has been updated']);
            }

            return response()->json(['message'=>'skill has been created']);
        }catch(Throwable $e){
            return response()->json(['message'=>'smth has wrong','error'=>$e]);
        }
    }
}
