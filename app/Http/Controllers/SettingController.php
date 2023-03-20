<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function shopRating()
    {
        return view('dashboard.shoprating');
    }

    public function shopRatingStore(Request $request)
    {
        // 
    }

    public function shopRatingDelete(Setting $setting)
    {
        // 
    }
}
