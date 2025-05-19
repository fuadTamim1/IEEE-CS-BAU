<?php

namespace App\Services;

use App\Http\Requests\Mails\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function send($data)
    {

        Mail::to('fuad89573@gmail.com')->send(new ContactMail($data));

        // Redirect or return response
        return true;
    }
}
