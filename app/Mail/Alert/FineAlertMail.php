<?php

namespace App\Mail\Alert;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Services\MailContentServices;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class FineAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $truc_number;
    public $fines;
    public $content;

    /**
     * Create a new message instance.
     */
    public function __construct($truc_number, $fines)
    {
        $this->truc_number = $truc_number;
        $this->fines = "";

        foreach ($fines as $item) {
            $this->fines = $this->fines .$item."<br>";
        }

        $serv = new MailContentServices();
        $this->content = $serv->get_no_active_numbers('fine_deb', [
            "truc_number" => $truc_number,
            "fines" => $this->fines
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->content['subject'].((config('app.env') !== "production")?" (Тест)":""),

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'mail.alert.annul',
            view: 'mail.all_mail_template',
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
