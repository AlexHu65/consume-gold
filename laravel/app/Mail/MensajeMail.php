<?php

namespace App\Mail;

use App\Models\Comentario;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MensajeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje;

    public function __construct(Comentario $mensaje){
        $this->mensaje = $mensaje;
    }


    public function build(){
        return $this->from($this->mensaje->email)
            ->view('emails.comentario')
            ->bcc('alejandro@difraxion.com')
            ->subject('Mensaje Enviado desde la web de ' . setting('site.title'))
            ;
    }
}
