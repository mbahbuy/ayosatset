<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Order, Product};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator};
use Illuminate\Validation\{Rule};

class OrderController extends Controller
{
    public function index(){
        return view('dashboard.orderlist',[
            'orders' => Order::orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function store(Request $request){
        if (!auth()->check()) {
            return response()->json(['data' => 'Anda harus login dulu!']);
        }
        $rules = Validator::make( $request->all(), [
            'data.*.value' => 'required|string',
            'data.*.pcs' => 'required|integer|min:1'
        ]);
        if($rules->fails()){
            return response()->json(['data' => 'Invalid input!']);
        }
        $data = $request->input('data');
        foreach ($data as $item) {
            $hash = Cart::select('product_hash')->where('cart_hash', $item['value'])->first();
            Cart::where('cart_hash', $item['value'])->delete();
            $payment = Product::select('price')->where('product_hash', $hash['product_hash'])->first();
            $makeorder = new Order;
            $makeorder->user_hash = auth()->user()->user_hash;
            $makeorder->product_hash = $hash['product_hash'];
            $makeorder->code = 'ASS-' . $makeorder->user_hash;
            $makeorder->pcs = $item['pcs'];
            $makeorder->payment = $payment['price']*$item['pcs'];
            $makeorder->status = true;
            $makeorder->save();
        }
        return response()->json(['data' => 'Tolong lakukan pembayaran untuk mempercepat proses pengiriman!']);
    }
}
