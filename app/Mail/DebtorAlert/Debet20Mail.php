<?php

namespace App\Mail\DebtorAlert;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Debet20Mail extends Mailable
{
    use Queueable, SerializesModels;

    public $truc_number;
    public $annul_data;

    public $content;

    /**
     * Create a new message instance.
     */
    public function __construct($truc_number, $annul_data)
    {
        $this->truc_number = $truc_number;
        $this->annul_data = $annul_data;

        $serv = new MailContentServices();
        $this->content = $serv->get_no_active_numbers('debt20', [
            'truc_number' => $truc_number,
            'annul_data' => $annul_data
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: "Нет оплаты за пропуск ".$this->truc_number.". Отправляем на аннуляцию.",
            subject: $this->content['subject'].((config('app.env') !== "production")?" (Тест)":""),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'mail.debtor.debt15',
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
