<?php

namespace App\Listeners;

use App\Events\sendVerifyCodeEvent;
use App\Mail\sendVerifyCodeMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Throwable;

class sendVerifyCodeListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(sendVerifyCodeEvent $event)
    {
        try{

            $User = User::where('email',$event->email)->first() ?: null;
            if(!$User){
                return ['status'=>200,'message'=>'account has not found'];
            }


            $User->email_active_code = random_int(0000,9999);
            $UserCode = $User->email_active_code ?: null;
            $User->update();




            Mail::to($event->email)->send(new sendVerifyCodeMail($UserCode,$User->name));
            return ['status'=>200,'message'=>'mail has been sended'];

        }catch(Throwable $e){
            return ['status'=>500,'error'=>$e];
        }
    }
}
