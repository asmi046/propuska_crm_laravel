<?php

namespace App\Mail\Alert;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Services\MailContentServices;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MainPassEnd60Mail extends Mailable
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
        $this->content = $serv->get_no_active_numbers('main_pass_end_60', $pass);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: "До окончания пропуска на ".$this->pass['truck_num']." осталось 60 дней".((config('app.env') !== "production")?" (Тест)":""),
            subject: $this->content['subject'].((config('app.env') !== "production")?" (Тест)":""),
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
