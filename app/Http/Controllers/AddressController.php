<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Storage, Validator};
use Illuminate\Validation\{Rule};

class AddressController extends Controller
{
    public function storeProfile(Request $request)
    {
        $rules = Validator::make($request->all(), [
            'status' => 'required|integer|min:1',
            'province_id' => 'required|integer|min:1',
            'city_id' => 'required|integer|min:1',
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);
        if ($rules->fails()) {
            return back()->withInput()->withErrors($rules, 'address_store');
        }
        $data = $rules->validated();
        $use = Address::where('user_hash', auth()->user()->user_hash)->exists() ? false : true;
        $data['use'] = $use;
        $data['user_hash'] = auth()->user()->user_hash;
        Address::create($data);
        return back()->with('success', 'Alamat baru telah ditambahkan');
    }

    public function updateProfile(Request $request, Address $address)
    {
        if ($address->user_hash !== auth()->user()->user_hash) {
            return back()->with('success', 'DON\'T DO ANYTHING STUPID!!!');
        }
        $rules = Validator::make($request->all(), [
            'status' => 'required|integer|min:1',
            'province_id' => 'required|integer|min:1',
            'city_id' => 'required|integer|min:1',
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);
        if ($rules->fails()) {
            return back()->withInput()->withErrors($rules, 'address_update_' . $address->id);
        }
        $data = $rules->validated();
        $data['use'] = $address->use;
        $address->update($data);
        return back()->with('success', 'Alamat telah diperbarui');
    }

    public function deleteProfile(Address $address)
    {
        $address->delete();
        return back()->with('success', 'Alamat telah dihapus');
    }

    public function storeShop(Request $request)
    {
        $rules = Validator::make($request->all(), [
            'status' => 'required|integer|min:1',
            'province_id' => 'required|integer|min:1',
            'city_id' => 'required|integer|min:1',
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);
        if ($rules->fails()) {
            return back()->withInput()->withErrors($rules, 'address_store');
        }
        $data = $rules->validated();
        if (Address::where('user_hash', auth()->user()->shop->shop_hash)->exists()) {
            return back()->with('success', 'Maaf, Alamat untuk toko cuma boleh ada 1');
        }
        $data['use'] = true;
        $data['shop_hash'] = auth()->user()->shop->shop_hash;
        Address::create($data);
        return back()->with('success', 'Alamat baru telah ditambahkan');
    }

    public function updateShop(Request $request, Address $address)
    {
        if ($address->shop_hash !== auth()->user()->shop->shop_hash) {
            return back()->with('success', 'DON\'T DO ANYTHING STUPID!!!');
        }
        $rules = Validator::make($request->all(), [
            'status' => 'required|integer|min:1',
            'province_id' => 'required|integer|min:1',
            'city_id' => 'required|integer|min:1',
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);
        if ($rules->fails()) {
            return back()->withInput()->withErrors($rules, 'address_update_' . $address->id);
        }
        $data = $rules->validated();
        $data['use'] = $address->use;
        $address->update($data);
        return back()->with('success', 'Alamat telah diperbarui');
    }

    // public function deleteShop(Address $address)
    // {
    //     $address->delete();
    //     return back()->with('success', 'Alamat telah dihapus');
    // }

    public function toggleUse(Address $address)
    {
        if ($address->user_hash !== auth()->user()->user_hash) {
            return back()->with('success', 'DON\'T DO ANYTHING STUPID!!!');
        }
        Address::where('user_hash', auth()->user()->user_hash)->update(['use' => false]);
        $address->update(['use' => true]);
        return response()->json(['data' => 'Alamat telah dipilih sebagai default']);
    }
}
