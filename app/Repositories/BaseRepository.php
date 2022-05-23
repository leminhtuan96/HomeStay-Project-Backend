<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Impl\BaseInterface;

abstract class BaseRepository implements BaseInterface
{
    public $table;
    public $model;
    public function __construct()
    {
        $this->table = $this->getTable();
        $this->model = $this->getModel();
    }
    public abstract function getModel();
    public abstract function getTable();

    public function getAll()
    {

        return DB::table($this->table)->get();
    }
    public function getById($id)
    {

        return DB::table($this->table)->where('id', $id)->first();
    }
    public function deleteById($id)
    {

        DB::table($this->table)->where('id', $id)->delete();
    }
}
