<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produtos extends AbstractModel
{
    protected static $_lists_row = "nome";
    protected static $_order = "nome";

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
