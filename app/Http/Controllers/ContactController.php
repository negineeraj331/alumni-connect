<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Mail::raw(
            "Name: {$validated['name']}\nEmail: {$validated['email']}\nSubject: {$validated['subject']}\n\nMessage:\n{$validated['message']}",
            function ($mail) use ($validated) {
                $mail->to('negineeraj811@gmail.com')
                     ->replyTo($validated['email'], $validated['name'])
                     ->subject('Alumni Connect Contact: ' . $validated['subject']);
            }
        );

        return back()->with('success', 'Your message has been sent successfully! We will get back to you shortly.');
    }
}
