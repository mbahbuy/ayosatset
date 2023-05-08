<?php

namespace App\Http\Controllers;

use App\Models\{Product};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Storage, Validator, Response};
use Illuminate\Validation\{Rule};


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productJson()
    {
        $products = Product::with('wish')->withCount('ratings')->latest()->paginate(10);
        return response()->json($products);
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
        $rules = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'price' => 'required|numeric|max:99999999999999999999',
            'quantity' => 'required|numeric|max:999999999',
            'categories' => [
                'required',
                Rule::exists('categories', 'slug')
            ],
            'image' => 'required|image|file|max:2048',
            'description' => 'required'
        ]);
        if ($rules->fails()) {
            return back()->withInput()->withErrors($rules, 'product_store');
        }
        $validatedData = $rules->validated();
        $validatedData['image'] = $request->file('image')->store('product-image');

        $validatedData['shop_hash'] = auth()->user()->shop->shop_hash;
        $validatedData['product_hash'] = md5($validatedData['shop_hash'] . $validatedData['name']);
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
        return view('home.single_product', [
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
        $rules = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'price' => 'required|numeric|max:99999999999999999999',
            'quantity' => 'required|numeric|max:999999999',
            'categories' => [
                'required',
                Rule::exists('categories', 'slug')
            ],
            'image' => 'nullable|image|file|max:2048',
            'description' => 'required'
        ]);
        if ($rules->fails()) {
            return back()->withInput()->withErrors($rules, 'product_update_' . $product->product_hash);
        }
        $validatedData = $rules->validated();
        $validatedData['image'] = $request->file('image') ? $request->file('image')->store('product-image') : $request['old_image'];
        $validatedData['product_hash'] = $validatedData['name'] !== $product->name ? md5($product->shop_hash . $validatedData['name']) : $product->product_hash;
        $product->update($validatedData);

        return back()->with('success', 'The product has been change!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        $product->delete();
        return back()->with('success', $product->name . ' telah dihapus!');
    }

    public function visibility(Request $request, Product $product)
    {
        $rules = Validator::make($request->all(), [
            'status' => 'required|numeric|in:1,0'
        ]);
        if ($rules->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $rules->getMessageBag()->toArray()
            ), 400);
        }
        $data = $rules->validated();
        $product->update(['status' => (int)$data['status']]);
        if ($data['status'] == 0) {
            return response()->json(['data' => 'Produk(' . $product->name . ') telah disembunyikan!']);
        }
        return response()->json(['data' => 'Produk(' . $product->name . ') telah ditampilkan!']);
    }
}
