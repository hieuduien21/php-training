<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Products;

class ProductsController extends BaseController
{
    public function index()
    { 
        $data = Products::where('active', 1)->orderBy('name')->get(); 
        dd($data);
        return view('products/products', ['data' => $data]);
    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function detail()
    {

    }
}
