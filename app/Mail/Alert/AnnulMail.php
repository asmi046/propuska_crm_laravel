<?php

namespace App\Mail\Alert;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AnnulMail extends Mailable
{
    use Queueable, SerializesModels;

    public $truc_number;
    public $pass;
    public $time;
    /**
     * Create a new message instance.
     */
    public function __construct($truc_number, $pass, $time)
    {
        $this->truc_number = $truc_number;
        $this->pass = $pass;
        $this->time = $time;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Пропуск на автомобиль ".$this->truc_number." будет аннулирован завтра",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.alert.annul',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
