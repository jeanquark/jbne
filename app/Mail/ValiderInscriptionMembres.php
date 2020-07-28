<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ValiderInscriptionMembres extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var order
     */
    public $member;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Validation de votre inscription au JBNE';

        return $this->markdown('emails.validation_inscription_membres')
            ->subject($subject);
    }
}
