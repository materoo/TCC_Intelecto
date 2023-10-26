<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailSenha extends Mailable
{
    use Queueable, SerializesModels;

    private $info;
    /**
     * Create a new message instance.
     */
    public function __construct(\stdClass $info)
    {
        $this->info = $info;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Enviar Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'senha.email_senha',
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

    public function build(){
        $this->subject('Assunto');
        $this->to($this->info->email);
        return $this->view('senha.confirmar_email_senha', ['info' => $this->info]);
    }
}
