<?php

namespace App\Mail\Alert;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Services\MailContentServices;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class StsAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $truc_number;
    public $sts_data;
    public $content;

    /**
     * Create a new message instance.
     */
    public function __construct($truc_number, $sts_data)
    {
        $this->truc_number = $truc_number;
        $this->sts_data = $sts_data;

        $serv = new MailContentServices();
        $this->content = $serv->get_no_active_numbers('sts_ch', [
            "truc_number" => $truc_number,
            "sts_data" => $this->sts_data
        ]);

        // dd($this->content);
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
