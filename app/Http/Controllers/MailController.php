<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email',
            'phone'         => 'nullable|string|max:20',
            'message'       => 'required|string',
        ]);

        // Optionally send an email using a Mailable
        Mail::to('fuad89573@gmail.com')->send(new ContactMail($validated));

        // Redirect or return response
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
