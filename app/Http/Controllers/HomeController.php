<?php

namespace App\Http\Controllers;

use App\Models\{Category, Product};
use Illuminate\Http\{Request};

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'products' => Product::with('cart', 'wish')->withCount('ratings')->whereHas('shop', function ($p) {
                $p->where('status', true);
            })->where('status', true)->orderByRaw('quantity = 0')->latest()->paginate(10)
        ]);
    }

    public function product()
    {
        return view('home.product', [
            'products' => Product::latest()->filter(request(['search', 'category']))->whereHas('shop', function ($p) {
                $p->where('status', true);
            })->where('status', true)->orderByRaw('quantity = 0')->paginate(10)->withQueryString()
        ]);
    }
}
