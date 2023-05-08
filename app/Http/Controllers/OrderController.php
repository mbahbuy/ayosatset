<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Order, Product, Rating};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator, Response};
use Illuminate\Validation\{Rule};
use PhpParser\Node\Expr\New_;

class OrderController extends Controller
{
    public function index()
    {
        return view('dashboard.orderlist', [
            'orders' => Order::with('shop', 'user')->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-aQM_3frZiZYbCModMeXYvfHM';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        if (!auth()->check()) {
            return response()->json(['data' => 'Anda harus login dulu!']);
        }
        $rules = Validator::make($request->all(), [
            'data.*.shop_hash' => 'required|string',
            'data.*.products.*.product_hash' => 'required|string',
            'data.*.products.*.cart_hash' => 'required|string',
            'data.*.products.*.price' => 'required|numeric|max:99999999999999999999',
            'data.*.products.*.pcs' => 'required|integer|min:1',
            'data.*.ongkir' => 'required|numeric|max:99999999999999999999'
        ]);
        if ($rules->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $rules->getMessageBag()->toArray()
            ), 400);
        }
        $data = $request->input('data');

        foreach ($data as $item) {
            $subTotal = 0;
            $products = array();
            foreach ($item['products'] as $product) {
                $subTotal += (int)$product['price'] * (int)$product['pcs'];
                Cart::where('cart_hash', $product['cart_hash'])->delete();
                $quantity = Product::select('quantity')->where('product_hash', $product['product_hash'])->first();
                Product::where('product_hash', $product['product_hash'])->update(['quantity' => (int)$quantity['quantity'] - (int)$product['pcs']]);
                array_push($products, ['product_hash' => $product['product_hash'], 'pcs' => $product['pcs']]);
            }
            $makeorder = new Order;
            $makeorder->user_hash = auth()->user()->user_hash;
            $makeorder->shop_hash = $item['shop_hash'];
            $makeorder->order_hash = md5($makeorder->user_hash . $makeorder->shop_hash . now());
            $makeorder->products = json_encode($products);
            $makeorder->sub_total = $subTotal;
            $makeorder->ongkir = $item['ongkir'];
            $makeorder->payment = (int)$subTotal + (int)$item['ongkir'];
            $makeorder->status = true;

            $getCodeToken = array(
                'transaction_details' => array(
                    'order_id' => $makeorder->order_hash,
                    'gross_amount' => $makeorder->payment,
                ),
                'customer_details' => array(
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => auth()->user()->alamat->phone,
                ),
            );
            $snapToken = \Midtrans\Snap::getSnapToken($getCodeToken);

            $makeorder->code = $snapToken;
            $makeorder->save();
        }
        return response()->json(['data' => 'Tolong lakukan pembayaran untuk mempercepat proses pengiriman!']);
    }

    public function midtrans(Order $order)
    {
        $order->update(['status' => 3]);
        return back()->with('success', 'Pembayaran Berhasil');
    }

    public function resi(Request $request, Order $order)
    {
        $rules = Validator::make($request->all(), ['resi' => 'required|min:3']);
        if ($rules->fails()) {
            return back()->withErrors($rules, 'resi-' . $order->order_hash);
        }
        $data = $rules->validated();
        $order->update(['no_resi' => $data['resi'], 'status' => 4]);
        return back()->with('success', 'Pengiriman akan dilakukan');
    }

    public function kurir(Request $request, Order $order)
    {
        $rules = Validator::make($request->all(), ['kurir' => 'required|image|file|max:2048']);
        if ($rules->fails()) {
            return back()->withErrors($rules, 'kurir-' . $order->order_hash);
        }
        $image = $request->file('kurir')->store('kurir-image');

        $order->update(['status' => 5, 'img_kurir' => $image]);
        return back()->with('success', 'Barang sudah tiba');
    }

    public function productConfirm(Request $request, Order $order)
    {
        $rules = Validator::make($request->all(), [
            'data.*.product' => [
                'required',
                Rule::exists('products', 'product_hash')
            ],
            'data.*.rating' => 'required|numeric|min:1|max:5',
            'data.*.image' => 'nullable|image|file|max:2048',
            'data.*.message' => 'nullable'
        ]);
        if ($rules->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $rules->getMessageBag()->toArray()
            ), 400);
        }
        $data = $request->input('data');
        foreach ($data as $item) {
            if (!is_null($item['image'])) {
                $item['image'] = $request->file('image') ? $request->file('image')->store('ratings-image') : '';
            }
            $rating = new Rating;
            $rating->product_hash = $item['product'];
            $rating->user_hash = auth()->user()->user_hash;
            $rating->rating = (int)$item['rating'];
            $rating->image = $item['image'];
            $rating->message = $item['message'];
            $rating->save();
        }
        $order->update(['status' => 6]);
        return response()->json(['data' => 'Terimakasih telah belanja di market kami']);
    }

    public function cancel(Order $order)
    {
        foreach (json_decode($order->products) as  $p) {
            $quantity = Product::select('quantity')->where('product_hash', $p->product_hash)->first();
            Product::where('product_hash', $p->product_hash)->update(['quantity' => (int)$quantity->quantity + (int)$p->pcs]);
        }
        $order->update(['status' => 0]);
        return response()->json(['data' => 'Orderan dibatalkan!']);
    }
}
