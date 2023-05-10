<?php
require __DIR__ . '/Model.php';
require __DIR__ . '/Comment.php';

class Product extends Model
{
    protected $table = 'products';
    private $primaryKey = 'product_id';

    public function getTable(): string
    {
        return $this->table;
    }

    public function comment() 
    {
        $this->hasMany(Comment::class, $this->primaryKey);
    }
}