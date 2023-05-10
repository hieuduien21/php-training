<?php
require __DIR__ . '/Model.php';

class Product extends Model
{
    protected $table = 'products';
    private $name;
    private $fillAble = [
        'name',
        'price'
    ];

    public function getTable(): string
    {
        return $this->table;
    }

    public function fillAble()
    {
        return $this->fillAble;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}