<?php
require __DIR__ . '/Model.php';
require __DIR__ . '/Product.php';
require __DIR__ . '/Brand.php';

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    public function getTable(): string
    {
        return $this->table;
    }

    public function products() 
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function brands() 
    {
        return $this->hasMany(Brand::class, 'category_id');
    }
}