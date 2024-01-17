<?php

// ContactController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Log;



class ContactController extends Controller
{

    public function sendEmail(Request $request)
    {

        // Validation des entrées
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Nettoyer les champs du formulaire après validation
            $name = strip_tags($validatedData['name']);
            $email = strip_tags($validatedData['email']);
            $message = strip_tags($validatedData['message']);

            

            // Construire le tableau de données
            $data = [
                'name' => $name,
                'email' => $email,
                'message' => $message,
            ];

            Mail::send('email.email', ['data' => $data], function ($message) use ($data) {
                $message->from($data['email']);
                $message->to('pascal.vigneau.web@gmail.com')->subject('Contact from my portfolio');
            });

            // Redirection en cas de succès
            return redirect('/success');
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return back()->with('error', 'There was a problem sending your message.');
        }
    }
}

// ContactController.php
