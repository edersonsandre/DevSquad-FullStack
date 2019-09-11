<?php

namespace App\Events;

use App\Helpers\UploadHelper;
use App\Model\ProdutosUpload;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProdutosUploadEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function saving(ProdutosUpload $model)
    {
        $model = $this->clear($model);
        $file = $this->uploadCSV($model);

        if (!is_null($file)) {
            $model->file = $file;
            $model->save();
        }
    }

    public function saved(ProdutosUpload $model)
    {
        Cache::tags($model->_getTag())->flush();
    }

    private function uploadCSV($model)
    {
        $file = UploadHelper::produtosCSV($model->file);

        return $file;
    }

    public function clear($model)
    {
        $model->user = Auth::user()->id;

        return $model;
    }

}
