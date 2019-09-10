<?php

namespace App\Model;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

abstract class AbstractModel extends Model
{
    protected static $_lists_row = "id";
    protected static $_order = "id";

    public function _get($id)
    {
        $key = $this->getTable() . "_get" . $id;

        if (!Cache::tags($this->_getTag())->has($key)) {
            $query = self::where('id', $id)->get();

            $data = !empty($query[0]) ? $query[0] : null;
            if (!is_null($data)) {
                Cache::tags($this->_getTag())->put($key, $data, CACHE_DAY);
            }

        } else {
            $data = Cache::tags($this->_getTag())->get($key);
        }

        return $data;
    }

    public function _save(array $data)
    {
        $_data = !empty($data['id']) ? self::find($data['id']) : $this;
        $columns = \DB::connection()->getSchemaBuilder()->getColumnListing($this->getTable());

        if (count($columns)) {
            try {
                foreach ($columns AS $column) {
                    if (array_key_exists($column, $data)) {
                        $_data->$column = $data[$column];
                    }
                }

                $_data->save();
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        return $_data;
    }

    public function _lists()
    {
        $data = [];
        $key = $this->getTable() . "_lists";

        if (!Cache::tags($this->_getTag())->has($key)) {
            $data = $this->orderBy($this->_getOrderBy())->pluck($this->_getListsColumns(), 'id');

            if (count($data)) {
                $data = $data->toArray();
                Cache::tags($this->_getTag())->put($key, $data, CACHE_WEEK);
            }
        } else {
            $data = Cache::tags($this->_getTag())->get($key);
        }

        return $data;
    }

    public function _delete($id)
    {
        $data = $this->_get($id);

        if ($data) {
            $data->delete();
        }

        return true;
    }

    public function _listagem($search = null)
    {
        $select = $this->select("*")->orderBy($this->_getOrderBy(), 'asc');

        return $this->_setParams($select, $search)->paginate(PAGINATION_PAGES);
    }

    public function _setParams($model, $search = null)
    {
        if (!empty($search)) {
            $table = $this->getTable();
            $columns = \DB::connection()->getSchemaBuilder()->getColumnListing($table);

            if (count($columns)) {
                foreach ($columns AS $column) {

                    if (in_array($column, array('created_at', 'updated_at', 'ativo', 'deleted_at')))
                        continue;

                    $model->oRwhere($table . "." . $column, 'LIKE', "%{$search}%");
                }
            }
        }

        return $model;
    }

    public function _getTag()
    {
        return $this->getTable();
    }

    protected function _getOrderBy()
    {
        return !empty(self::$_order) ? self::$_order : 'id';
    }


    /*
     * @codeCoverageIgnore
     */
    protected function _getListsColumns()
    {
        return self::$_lists_row;
    }

}
