<?php

class Brand extends Model
{
    protected $table = 'brands'; 

    public function getTable(): string
    {
        return $this->table;
    } 
}