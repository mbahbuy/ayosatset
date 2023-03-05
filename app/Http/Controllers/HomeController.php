<?php

namespace App\Http\Controllers;

use App\Models\{Category, Product};
use Illuminate\Http\{Request};

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index',[
            'products' => Product::orderBy('id', 'DESC')->get()
        ]);
    }

    public function product()
    {
        return view('home.product',[
            'products' => Product::orderBy('id', 'DESC')->get()
        ]);
    }
}
