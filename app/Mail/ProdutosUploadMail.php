<?php

namespace App\Mail;

use App\Model\ProdutosUpload;
use App\Model\Usuarios;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProdutosUploadMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param ProdutosUpload $upload
     * @param array $log
     */
    public function __construct(ProdutosUpload $upload, array $log)
    {
        $this->upload = $upload;
        $this->log = $log;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $usuario = (new \App\Model\Usuarios)->_get($this->upload->user);

        return $this->view('mails.produtos.upload-csv')
            ->with('usuario', $usuario)
            ->with('upload', $this->upload)
            ->with('log', $this->log);
    }
}
