<?php

namespace App\Http\Controllers;

use App\Models\{Cart};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator};
use Illuminate\Validation\{Rule};

class CartController extends Controller
{
    public function store(Request $request){
        if (!auth()->check()) {
            return response()->json(['data' => 'Anda harus login dulu!']);
        }
        $rules = Validator::make( $request->all(), [
            'target' => [
                'required',
                Rule::exists('products', 'product_hash')
            ]
        ]);
        if($rules->fails()){
            return response()->json(['data' => 'Invalid input!']);
        }
        $data = $rules->validated();
        $cart['parent_id'] = 1;
        $cart['user_hash'] = auth()->user()->user_hash;
        $cart['product_hash'] = $data['target'];
        $cart['cart_hash'] = substr(md5($cart['parent_id'] . $data['target']), 0, 8);
        if (Cart::where([['parent_id', '=', $cart['parent_id']], ['user_hash', '=', $cart['user_hash'] ], ['product_hash', '=', $cart['product_hash'] ]])->exists()) {
            return response()->json(['data' => 'Produk telah ditambahkan kedalam keranjang']);
        }
        Cart::create($cart);
        return response()->json(['data' => 'Produk ditambahkan kedalam keranjang']);
    }

    public function wish(Request $request){
        if (!auth()->check()) {
            return response()->json(['data' => 'Anda harus login dulu!']);
        }
        $rules = Validator::make( $request->all(), [
            'target' => [
                'required',
                Rule::exists('products', 'product_hash')
            ]
        ]);
        if($rules->fails()){
            return response()->json(['data' => 'Invalid input!']);
        }
        $data = $rules->validated();
        $cart['parent_id'] = 2;
        $cart['user_hash'] = auth()->user()->user_hash;
        $cart['product_hash'] = $data['target'];
        $cart['cart_hash'] = substr(md5($cart['parent_id'] . $data['target']), 0, 8);
        $check = Cart::where([['parent_id', '=', $cart['parent_id']], ['user_hash', '=', $cart['user_hash'] ], ['product_hash', '=', $cart['product_hash'] ]]);
        if ($check->exists()) {
            $check->delete();
            return response()->json(['data' => 'Produk telah dihapus dari barang yang disukai']);
        }
        Cart::create($cart);
        return response()->json(['data' => 'Produk ditambahkan kedalam barang yang disukai']);
    }

    public function destroy(Cart $cart){
        $data = ($cart->parent_id = 1) ? 'keranjang!' : 'barang yang disuka!' ;
        $cart->delete();
        return response()->json(['data' => 'Produk telah dihapus dari ' . $data]);
    }
}
