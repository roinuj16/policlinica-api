<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $dados;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados, $view)
    {
        $this->dados = $dados;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(is_array($this->dados)) {
            return $this->from($this->dados['usuario']['email'], $this->dados['usuario']['nome'])
                ->subject($this->dados['usuario']['assunto'])
                ->view($this->view);
        }
        return $this->from($this->dados->email, $this->dados->nome)
                    ->subject($this->dados->assunto)
                    ->view($this->view);
    }
}
