<?php

namespace App\Events;

use App\Model\Produtos;
use App\Model\Usuarios;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UsuariosEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function saving(Usuarios $model)
    {
        $model = $this->clear($model);
    }

    private function clear(Usuarios $model)
    {
        if (!empty($model->password)) {
            $model->password = bcrypt($model->password);
        }
    }

}
