<?php

namespace App\Http\Controllers;

use App\Models\{Product};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator};
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'price' => 'required|max:20',
            'categories' => [
                'required',
                Rule::exists('categories', 'slug')
            ],
            'image' => 'required|image|file|max:2048',
            'description' => 'required'
        ]);
        if($rules->fails()){
            return back()->withInput()->withErrors($rules, 'product_store');
        }
        $validatedData = $rules->validated();
        $validatedData['image'] = $request->file('image')->store('product-image');

        $validatedData['shop_hash'] = auth()->user()->shop->shop_hash;
        $validatedData['product_hash'] = substr(md5($validatedData['shop_hash'].$validatedData['name'] ), 0, 12);
        Product::create($validatedData);

        return back()->with('success', 'New product has been added!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('home.single_product',[
            'title' => $product->name,
            'produk' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'price' => 'required|max:20',
            'categories' => [
                'required',
                Rule::exists('categories', 'slug')
            ],
            'image' => 'required|image|file|max:2048',
            'description' => 'required'
        ]);
        if($rules->fails()){
            return back()->withInput()->withErrors($rules, 'product_store');
        }
        $validatedData = $rules->validated();
        $validatedData['image'] = $request->file('image')->store('product-image');

        $validatedData['shop_hash'] = auth()->user()->shop->shop_hash;
        $validatedData['product_hash'] = substr(md5($validatedData['shop_hash'].$validatedData['name'] ), 0, 12);
        Product::create($validatedData);

        return back()->with('success', 'New product has been added!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
