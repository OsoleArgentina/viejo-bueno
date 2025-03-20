<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PresupuestoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Solicitud de presupuesto.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.presupuesto-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $archivosAdjuntos = [];

        // Verifica si hay archivos en los datos
        if (isset($this->data['archivos']) && is_array($this->data['archivos'])) {
            foreach ($this->data['archivos'] as $archivo) {
                // Construye la ruta del archivo
                $archivoPath = storage_path('app/public/' . $archivo);
                
                // Adjunta el archivo
                $archivosAdjuntos[] = \Illuminate\Mail\Mailables\Attachment::fromPath($archivoPath)
                    ->as(basename($archivo)) // Nombre del archivo
                    ->withMime(mime_content_type($archivoPath)); // Tipo MIME del archivo
            }
        }
    
        return $archivosAdjuntos;
    }
}
