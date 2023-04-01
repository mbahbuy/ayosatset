<?php

namespace App\Http\Controllers;

use App\Models\{RajaOngkir};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Validator, Response};

class RajaOngkirController extends Controller
{
    public function provinsi()
    {
        return RajaOngkir::ProvinceAll();
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
        return RajaOngkir::CityOfProvince($data['kota']);
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
        // return response()->json(['data' => $data]);
        return RajaOngkir::Ongkir((int)$data['origin'], (int)$data['tujuan'], $data['jasa']);
    }
}
