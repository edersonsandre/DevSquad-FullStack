<?php

namespace App\Events;

use App\Helpers\UploadHelper;
use App\Model\Produtos;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Cache;

class ProdutosEvent
{
    use SerializesModels;

//    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function saving(Produtos $model)
    {


        $model = $this->clear($model);
    }

    public function deleted(Produtos $model)
    {
        if (file_exists(public_path($model->imagem))) {
//            unlink(public_path($model->imagem));
            UploadHelper::RemoverPath(public_path("uploads/produtos/{$model->id}"));
        }

        Cache::tags($model->_getTag())->flush();
    }

    public function saved(Produtos $model)
    {
        Cache::tags($model->_getTag())->flush();

        $imagem = $this->upload($model);
    }

    private function upload($model)
    {
        $imagem = UploadHelper::produto($model);

        if (!is_null($imagem)) {
            $model->imagem = $imagem;
            $model->save();
        }

        return $imagem;
    }

    public function clear($model)
    {
        $model->preco = number_format(preg_replace("/[^0-9]/", "", $model->preco) / 100, "2", ".", "");
        if (empty($model->imagem)) {
            unset($model->imagem);
        }

        return $model;
    }

}
