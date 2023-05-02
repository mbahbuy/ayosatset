<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{Http};

class RajaOngkir extends Model
{
    protected static $token = "68bff9293fa5067ce7186bf8c148c0e3";

    public static function Ongkir($origin = 6, $destination = 444, $courier = 'jne')
    {
        $response = Http::asForm()->withHeaders([
            "content-type" => "application/x-www-form-urlencoded",
            "key" => self::$token
        ])->post("https://api.rajaongkir.com/starter/cost", [
            "origin" => $origin,
            "destination" => $destination,
            "weight" => 1300,
            "courier" =>  $courier
        ]);
        // $costs = json_decode($response);
        $costs = $response['rajaongkir']['results'];
        return response()->json($costs);
    }
}
