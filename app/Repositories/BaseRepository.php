<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /** @var Model $model */
    protected $model;

    /**
     * @return mixed
     */
    public function getAll()
    {
        return app($this->model)::all();
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return app($this->model)->getTable();
    }

    /**
     * @param int $id
     * @return false|mixed|null
     */
    public function find(int $id)
    {
        $items = app($this->model)::query()->where('id', $id)->get(['*']);

        return $items ? current(current($items)) : null;
    }

}
