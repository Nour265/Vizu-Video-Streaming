<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function sendContactEmail(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        // Admin Email
        $adminEmail = "ghadiabk05@gmail.com"; // Change this to your admin email

        // Send email using Laravel Mail
        Mail::raw(
            "Name: {$request->name}\nEmail: {$request->email}\n\nMessage:\n{$request->message}",
            function ($message) use ($request, $adminEmail) {
                $message->to($adminEmail)
                    ->subject("New Contact Inquiry from " . $request->name);
            }
        );

        return redirect()->route('contact.show')->with('success', 'Your message has been sent!');
    }
}