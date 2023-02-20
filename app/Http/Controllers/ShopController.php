<?php

namespace App\Http\Controllers;

use App\Models\{Product,Shop};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator};

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->shop == false) {
            return redirect('/profile');
        }
        return view('shop.index',[
            'product' => Product::where('shop_hash', auth()->user()->shop->shop_hash)->orderBy('id', 'DESC')->get()
        ]);
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
        $rules = Validator::make( $request->all(), [
            'name' => 'required|max:255',
            'description' => 'required'
        ]);
        if($rules->fails()){
            return back()->withInput()->withErrors($rules, 'create_shop');
        }
        $validatedData = $rules->validated();
        $validatedData['user_hash'] = auth()->user()->user_hash;
        $validatedData['shop_hash'] = substr(md5($validatedData['user_hash'].$validatedData['name'] ), 0, 12);
        Shop::create($validatedData);

        return redirect('/shop');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return view('home.shop',[
            'products' => Product::where('shop_hash', $shop->shop_hash)->orderBy('id', 'DESC')->get(),
            'shop' => $shop
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $rules = Validator::make( $request->all(), [
            'banner' => 'required|image|file|max:2048',
            'image' => 'required|image|file|max:2048',
            'name' => 'required|max:255',
            'description' => 'required'
        ]);
        if($rules->fails()){
            return back()->withInput()->withErrors($rules, 'shop_update');
        }
        $validatedData = $rules->validated();
        $validatedData['image'] = $request->file('image')->store('shop-image');
        $validatedData['banner'] = $request->file('banner')->store('shop-image');

        $shop->update($validatedData);
        return back()->with('succes', 'Settings Shop has update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
