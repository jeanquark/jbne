<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Error extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The data instance.
     *
     * @var Order
     */
    public $exception;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Notification d\'erreur';

        return $this->markdown('emails.error')
            ->subject($subject);
    }
}
