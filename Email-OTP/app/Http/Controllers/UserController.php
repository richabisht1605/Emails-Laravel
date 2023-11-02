<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Suppport\Facades\Hash;
use Illuminate\Suppport\Facades\Auth;
use Illuminate\Suppport\Facades\Session;
use Mail;

class UserController extends Controller
{
   public function home()
   {
    return view('home');
   }


}
