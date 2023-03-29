<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Order, Product, Rating};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator, Response};
use Illuminate\Validation\{Rule};
use PhpParser\Node\Expr\New_;
use Kavist\RajaOngkir\Facades\RajaOngkir;

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
            foreach ($item['products'] as $product) {
                $price = Product::select('price')->where('product_hash', $product['product_hash'])->first();
                $subTotal += (int)$price['price'] * (int)$product['pcs'];
                Cart::where([
                    ['user_hash', '=', auth()->user()->user_hash],
                    ['product_hash', '=', $product['product_hash']],
                    ['parent_id', '=', 1]
                ])->delete();
            }
            $makeorder = new Order;
            $makeorder->user_hash = auth()->user()->user_hash;
            $makeorder->shop_hash = $item['shop_hash'];
            $makeorder->order_hash = md5($makeorder->user_hash . $makeorder->shop_hash . now());
            $makeorder->products = json_encode($item['products']);
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
            'rating' => 'required|numeric|min:1|max:5',
            'image' => 'nullable|image|file|max:2048',
            'message' => 'required|min:5'
        ]);
        if ($rules->fails()) {
            return back()->withErrors($rules, 'rating_' . $order->order_hash);
        }
        $data = $rules->validated();
        $data['image'] = $request->file('image') ? $request->file('image')->store('ratings-image') : '';
        $rating = new Rating;
        $rating->product_hash = $order->product_hash;
        $rating->rating = $data['rating'];
        $rating->image = $data['image'];
        $rating->message = $data['message'];
        $rating->save();
        $order->update(['status' => 6]);
        return back()->with('success', 'Terimakasih telah belanja di market kami');
    }

    public function provinsi()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        return response()->json($daftarProvinsi);
    }

    public function kota(Request $request)
    {
        $rules = Validator::make($request->all(), [
            'kota' => 'required|numeric'
        ]);

        if ($rules->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $rules->getMessageBag()->toArray()
            ), 400);
        }
        $data = $rules->validated();
        $daftarKota = RajaOngkir::kota()->dariProvinsi($data['kota'])->get();
        return response()->json($daftarKota);
    }

    public function ongkir(Request $request)
    {
        $rules = Validator::make($request->all(), [
            'origin' => 'required|numeric',
            'tujuan' => 'required|numeric',
            'jasa' => 'required|in:jne,tiki,pos'
        ]);

        if ($rules->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $rules->getMessageBag()->toArray()
            ), 400);
        }
        $data = $rules->validated();
        $ongkir = RajaOngkir::ongkir([
            'origin'        => $data['origin'],     // ID kota/kabupaten asal
            'destination'   => $data['tujuan'],      // ID kota/kabupaten tujuan
            'weight'        => 1300,    // berat barang dalam gram
            'courier'       => $data['jasa']    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        return response()->json($ongkir);
    }
}
