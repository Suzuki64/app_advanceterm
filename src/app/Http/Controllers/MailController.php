<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Http\Requests\MailRequest;

class MailController extends Controller
{
    public function send(MailRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'message' => $request->input('message')
        ];
 
        $email = $request->input('email');

        Mail::to($email)->send(new SendMail($data));

        return back();
    }
}
