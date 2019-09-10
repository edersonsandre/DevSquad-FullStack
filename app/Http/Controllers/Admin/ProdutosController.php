<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\Admin\ProdutoRequest;
use App\Model\Produtos;
use Illuminate\Support\Facades\App;


class ProdutosController extends AbstractController
{
    public function __construct()
    {
        $this->_model = new Produtos();
        $this->_title = "Produtos";
    }

    public function save(ProdutoRequest $request)
    {
        $response['status'] = false;

        try {
            $this->_model->_save($request->all());

            $response['status'] = true;
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function edicao($id = null)
    {
        $view = parent::edicao($id);

        $view->model->preco = str_replace(".", ',', $view->model->preco);

        return $view;
    }

    public function visualizar($id = null){
        try {
            if (is_null($id))
                throw new \Exception(trans('app.registro-nao-encontrado'));

            $view = View(request()->route()->action['as']);
            $view->model = $this->_model->_get($id);

            if (empty($view->model->id)) {
                throw new \Exception(trans('app.registro-nao-encontrado'));
            }

            return $view;
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
