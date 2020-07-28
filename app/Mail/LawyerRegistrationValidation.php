<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LawyerRegistrationValidation extends Mailable
{
    use Queueable, SerializesModels;

    public $lawyer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lawyer)
    {
        $this->lawyer = $lawyer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Validation de votre inscription au JBNE';

        return $this->view('emails.verifyLawyer')
            ->subject($subject);
    }
}