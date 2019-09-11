<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produtos extends AbstractModel
{
    protected static $_lists_row = "nome";
    protected static $_order = "nome";

    public static function saveByCSV(array $data)
    {
        if (!empty($data['nome'])) {
            $produto = self::getProdutoNome($data['nome']);
            $data['id'] = $produto->id ?? null;

            return (new Produtos)->_save($data);
        }

        return null;
    }

    private static function getProdutoNome($nome = null)
    {
        if (!empty(strlen($nome))) {
            $data = self::where('nome', $nome)->get();

            return !empty($data[0]) ? $data[0] : null;
        }

        return null;
    }

    public function categorias()
    {
        return $this->hasOne(Categorias::class, 'id', 'categoria');
    }

    public function _getOrderBy()
    {
        return self::$_order;
    }

    public function _getListsColumns()
    {
        return self::$_lists_row;
    }

}
