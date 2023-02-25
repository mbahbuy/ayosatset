<?php

namespace App\Http\Controllers;

use App\Models\{Dashboard};
use Illuminate\Http\{Request};

class DashboardController extends Controller
{
    public function index(){
        if ( auth()->user()->admin_status == false || auth()->user()->editor_status == false ) { 
            abort(403);
        }
        return view('dashboard.index');
    }
}
