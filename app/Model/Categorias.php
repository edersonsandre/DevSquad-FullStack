<?php

namespace App\Model;


class Categorias extends AbstractModel
{
    protected static $_lists_row = "nome";

    public function _getListsColumns()
    {
        $row = parent::_getListsColumns();
        return ($row == "nome") ? $row : self::$_lists_row;
    }
}
