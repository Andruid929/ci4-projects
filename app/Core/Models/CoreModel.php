<?php

namespace App\Core\Models;

use CodeIgniter\Model;

class CoreModel extends Model
{

    protected $useAutoIncrement = true;
    protected $useSoftDeletes = false;
    protected $returnType = 'array';

    public function getByNum(int $num)
    {
        return $this->where($this->primaryKey, $num)->first();
    }

    public function addNewEntry(array $data)
    {
        return $this->save($data);
    }

    public function getAll(): array {
        return $this->select()->findAll();
    }

}