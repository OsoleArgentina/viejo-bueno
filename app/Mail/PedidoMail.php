<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $pedido;
    // public $nombre;
    // public $pais;
    // public $direccion;
    // public $direccion_detalle;
    // public $localidad;
    // public $codigo_postal;
    // public $telefono;
    // public $correo;
    // public $informacion_adicional;
    
    /**
     * Create a new message instance.
     */
    public function __construct($data, $pedido)
    {
        $this->data = $data;
        $this->pedido = $pedido;
        // dd( $this->pedido);
        // $this->nombre = $nombre;
        // $this->pais = $pais;
        // $this->direccion = $direccion;
        // $this->direccion_detalle = $direccion_detalle;
        // $this->localidad = $localidad;
        // $this->codigo_postal = $codigo_postal;
        // $this->telefono = $telefono;
        // $this->correo = $correo;
        // $this->informacion_adicional = $informacion_adicional;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo pedido.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.pedido-mail',
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
