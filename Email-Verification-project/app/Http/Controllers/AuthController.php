<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Mail\EmailVerificationMail;

class AuthController extends Controller
{

    public function getRegister()
    {
        return view ('register');
    }
    public function check_email_unique(Request $request)
    {
        $user = User::where('email',$request->email)->first();   
        if ($user){
            echo 'false';
        }else{
            echo 'true';
        }
    }
    public function postRegister(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|email|unique:users',
            'confirm_password'=>'required|same:password',
            
        ],[
            'name.reqired'=>'first name is required', 
            'email'=>'email is required', 

        ]);
        $body = json_decode((string)$response->getBody());

        if($body->success==true){

            $user=User::create([
                'name'=>$request->name,  
                'email'=>$request->email, 
                'password'=>$request->password, 

            ]);
            
            
            Mail::to($request->email)->send(new EmailVerificationMail($user));

            return redirect()->back()->with('success','Registration Success');

        }else{
             
            return redirect()->back()->with('error','Registration Unsuccessfull');

        }

       
    }
   
}
