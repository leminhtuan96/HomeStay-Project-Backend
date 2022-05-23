<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
          'title' => 'Thank you',
          'body'=>'Hello'
        ];
        Mail::to(Auth::user()->email)->send(new TestMail($details));
        return response()->json([
            'message' => 'Email sent success',
            'status'=>'success'
        ],201);
    }
}
