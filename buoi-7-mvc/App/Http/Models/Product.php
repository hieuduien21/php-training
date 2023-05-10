<?php

namespace App\Http\Models;

class Product extends BaseModel
{
    protected $table = 'products';

    public function getTable(): string
    {
        return $this->table;
    }
}
