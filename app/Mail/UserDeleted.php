<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserDeleted extends Mailable
{
    use Queueable, SerializesModels;

    protected $user; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('admin@example.org')
            ->markdown('emails.user.deleted')
            ->with(['name' => $this->user->name,]);
    }
}
