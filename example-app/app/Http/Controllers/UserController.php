<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController
{
    public function index(Request $request)
    {
        var_dump($request->method());    
    }
}
