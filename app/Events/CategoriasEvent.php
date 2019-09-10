<?php

namespace App\Events;

use App\Model\Categorias;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Cache;

class CategoriasEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function saved(Categorias $model)
    {
        Cache::tags($model->_getTag())->flush();
    }


}
