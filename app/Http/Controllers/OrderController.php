<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Order, Product, Rating};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator};
use Illuminate\Validation\{Rule};
use PhpParser\Node\Expr\New_;

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
            $payment = Product::select('price', 'shop_hash')->where('product_hash', $hash['product_hash'])->first();
            $makeorder = new Order;
            $makeorder->user_hash = auth()->user()->user_hash;
            $makeorder->product_hash = $hash['product_hash'];
            $makeorder->shop_hash = $payment['shop_hash'];
            $makeorder->code = 'ASS-' . $makeorder->user_hash;
            $makeorder->pcs = $item['pcs'];
            $makeorder->payment = $payment['price']*$item['pcs'];
            $makeorder->status = true;
            $makeorder->order_hash = substr(md5($makeorder->user_hash . $makeorder->product_hash . $makeorder->pcs . now() ), 0, 24);
            $makeorder->save();
        }
        return response()->json(['data' => 'Tolong lakukan pembayaran untuk mempercepat proses pengiriman!']);
    }

    public function payment(Request $request, Order $order)
    {
        $rules = Validator::make($request->all(),['payment' => 'required|image|file|max:2048']);
        if($rules->fails()){
            return back()->withErrors($rules, 'payment-' . $order->order_hash);
        }
        $image = $request->file('payment')->store('payment-image');

        $order->update(['status' => 2, 'img_payment' => $image]);
        return back()->with('success', 'Mohon tunggu konfirmasi pembayaran');
    }

    public function paymentConfirm(Order $order){
        $order->update(['status' => 3]);
        return back()->with('success', 'Berhasil menyetujui pembayaran');
    }

    public function resi(Request $request, Order $order)
    {
        $rules = Validator::make($request->all(),['resi' => 'required|min:3']);
        if($rules->fails()){
            return back()->withErrors($rules, 'resi-' . $order->order_hash);
        }
        $data = $rules->validated();
        $order->update(['no_resi' => $data['resi'], 'status' => 4]);
        return back()->with('success', 'Pengiriman akan dilakukan');
    }

    public function kurir(Request $request, Order $order)
    {
        $rules = Validator::make($request->all(),['kurir' => 'required|image|file|max:2048']);
        if($rules->fails()){
            return back()->withErrors($rules, 'kurir-' . $order->order_hash);
        }
        $image = $request->file('kurir')->store('kurir-image');

        $order->update(['status' => 5, 'img_kurir' => $image]);
        return back()->with('success', 'Barang sudah tiba');
    }

    public function productConfirm(Request $request, Order $order){
        $rules = Validator::make($request->all(),[
            'rating' => 'required|numeric|min:1|max:5',
            'image' => 'nullable|image|file|max:2048',
            'message' => 'required|min:5'
        ]);
        if($rules->fails()){
            return back()->withErrors($rules, 'rating_' . $order->order_hash);
        }
        $data = $rules->validated();
        $data['image'] = $request->file('image') ? $request->file('image')->store('ratings-image') : '' ;
        $rating = new Rating;
        $rating->product_hash = $order->product_hash;
        $rating->rating = $data['rating'];
        $rating->image = $data['image'];
        $rating->message = $data['message'];
        $rating->save();
        $order->update(['status' => 6]);
        return back()->with('success', 'Terimakasih telah belanja di market kami');
    }
}
