<?php

namespace App\Repositories\Clients;

use App\Models\Skill;
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
            'name'=>'required',
            'count' => 'required|max:100|numeric'
        ]);

        if($validation->fails()){
            return response()->json(['message'=>'validate error','error'=>$validation->getMessageBag(),'status'=>500],500);
        }


        try{
            $skill = User::find(auth('api')->user()->id)->skills()->updateOrCreate(['id'=>request()->id],request()->all());

            if(request()->id){
                return response()->json(['data'=>$skill,'message'=>'skill has been updated','status'=>200]);
            }

            return response()->json(['data'=>$skill,'message'=>'skill has been created','status'=>200]);
        }catch(Throwable $e){
            return response()->json(['message'=>'smth has wrong','error'=>$e]);
        }

    }

    public function destroy()
    {
        $validation = Validator::make(request()->all(),[
            'id'=>'required|numeric'
        ]);

        if($validation->fails()){
            return response()->json(['message'=>'validate error','error'=>$validation->getMessageBag(),'status'=>500],500);
        }

        try{
            Skill::find(request()->id)->delete();
            return response()->json(['data'=>User::find(auth('api')->user()->id)->skills,'status'=>200,'message'=>'skill has been deleted successfully'],200);
        }catch(Throwable $e){
            return response()->json(['status'=>500,'message'=>'smth has went wrong','error'=>$e],500);
        }
    }
}
