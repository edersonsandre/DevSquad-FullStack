<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

abstract class AbstractController extends Controller
{
    protected $_title;
    protected $_model = null;

    public function index()
    {
        $view = View(request()->route()->action['as'])->with('title', $this->_title);
        $view->grid = $this->_model->_listagem();

        return $view;
    }

    public function registro()
    {
        $view = View(request()->route()->action['as'])->with('title', $this->_title);

        $view->model = null;

        return $view;
    }

    public function edicao($id = null)
    {
        try {
            if (is_null($id))
                throw new \Exception(trans('app.registro-nao-encontrado'));

            $view = $this->getLayoutViewEdicao();
            $view->model = $this->_model->_get($id);

            if (empty($view->model->id)) {
                throw new \Exception(trans('app.registro-nao-encontrado'));
            }

            return $view;
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function getLayoutViewEdicao()
    {
        try {
            $view = View(request()->route()->action['as'])->with('title', $this->_title);
        } catch (\Exception $e) {
            $layout = str_replace(".edicao", ".registro", request()->route()->action['as']);
            $view = View($layout)->with('title', $this->_title);
        }

        return $view;
    }

    public function delete($id = null)
    {
        $response['status'] = false;

        try {
            if (is_null($id))
                throw new \Exception(trans('app.registro-nao-encontrado'));

            $this->_model->_delete($id);

            $response['status'] = true;
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
        }

        return $response;
    }


}
