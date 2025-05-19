<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
       $mailService = new MailService();

       $mailService->send($request);

        // Redirect or return response
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
