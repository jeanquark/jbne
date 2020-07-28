<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PermanencesRegistrationPeriod extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var order
     */
    public $lawyer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lawyer)
    {
        $this->lawyer = $lawyer;
        // dd($this->lawyer);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Ouverture de la période d\'enregistrement des disponibilités pour la permanence';

        return $this->markdown('emails.permanences_registration_period')
            ->subject($subject);
    }
}
