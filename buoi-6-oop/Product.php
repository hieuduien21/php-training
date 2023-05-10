<?php 
require __DIR__ . '/Comment.php';

class Product extends Model
{
    protected $table = 'products';

    public function getTable(): string
    {
        return $this->table;
    }

    public function comment() 
    {
        $this->hasMany(Comment::class, $this->primaryKey);
    }
}