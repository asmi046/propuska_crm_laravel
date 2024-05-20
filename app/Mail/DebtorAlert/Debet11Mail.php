<?php

namespace App\Mail\DebtorAlert;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Debet11Mail extends Mailable
{
    use Queueable, SerializesModels;

    public $truc_number;
    public $pass;
    public $time;
    /**
     * Create a new message instance.
     */
    public function __construct($truc_number)
    {
        $this->truc_number = $truc_number;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Нет оплаты за пропуск ".$this->truc_number." более 10 дней",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.debtor.debt10',
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
