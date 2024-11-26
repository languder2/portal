<?php

namespace App\Mail;

use  Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public object|array $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data,)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            bcc:            'languder1985@ya.ru',
            subject:        $this->data->subject,
        );
    }

    public function build(): SendEmail
    {

        return $this->view($this->data->template)
            ->with([
                'data'     => $this->data,
            ]);

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
