<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\DemoMail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Mail From Richa',
            'body' => 'This is testing email using SMPT',
        ];
       
        Mail::to('richa17111605@gmail.com')->send(new DemoMail($data));

        dd('Email Sent Successfully');

    }
}
