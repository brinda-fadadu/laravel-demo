<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GroceryDeletionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $groceries;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $groceries
     */
    public function __construct($user, $groceries)
    {
        $this->user = $user;
        $this->groceries = $groceries;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Grocery Added')
                    ->view('emails.grocery-deletion'); // Create this email view
    }
}
