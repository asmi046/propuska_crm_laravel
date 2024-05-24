<?php

namespace App\Mail\Alert;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TmpPassCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pass;

    /**
     * Create a new message instance.
     */
    public function __construct($pass)
    {
        $this->pass = $pass;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Вышел разовый пропуск для ".$this->pass['truck_num']." до ".date("d.m.Y", strtotime($this->pass['valid_to'])),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.alert.tmp_pass_created',
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
