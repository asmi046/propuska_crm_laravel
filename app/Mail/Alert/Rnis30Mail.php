<?php

namespace App\Mail\Alert;

use App\Services\MailContentServices;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Rnis30Mail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public $content;

    /**
     * Create a new message instance.
     */
    public function __construct($number, $end_subscribe)
    {
        $this->data = ['truc_number' => $number, 'valid_to' => $end_subscribe];
        $serv = new MailContentServices;
        $this->content = $serv->get_no_active_numbers('rnis_30_days', $this->data);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->content['subject'].((config('app.env') !== 'production') ? ' (Тест)' : ''),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'mail.alert.main_pass_end_60',
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
