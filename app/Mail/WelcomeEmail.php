<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     private user $user;  //here i  am defining a property of a user to be used in the contruct

    public function __construct(user $user)
    {
         $this->user = $user; // with the model, laravel has gotten an instance of the user from the database, and retrieved the data
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Welcome Email',   //this is the subject of the email sent
            
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.welcome-email', //this is the blade file that as the email template for welcoming users
            with: [
                'user' => $this->user   //this holds data of the user to be included in the email template, from the DB
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    //// TO SEND THE MAIL, WE GO TO USER-CONTROLLER 
}
