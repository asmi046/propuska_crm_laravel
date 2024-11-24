<?php

namespace App\Mail\Alert;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Services\MailContentServices;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MainPassCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pass;
    public $content;
    /**
     * Create a new message instance.
     */
    public function __construct($pass)
    {
        $this->pass = $pass;
        $serv = new MailContentServices();
        $this->content = $serv->get_no_active_numbers('main_pass_created', $pass);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Вышел постоянный пропуск для ".$this->pass['truck_num']." до ".date("d.m.Y", strtotime($this->pass['valid_to'])).((config('app.env') !== "production")?" (Тест)":""),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'mail.alert.main_pass_created',
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
