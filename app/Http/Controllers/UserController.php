<?php

namespace App\Http\Controllers;

use App\Models\{User,Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->middleware('verify')){
            return redirect('checkemail');
        }
        if (auth()->user()->name == '' || auth()->user()->name == null) {
            return redirect('profile/data/user');
        }
        $product = (auth()->user()->shop) ? Product::where('shop_hash', auth()->user()->shop->shop_hash)->orderBy('id', 'DESC')->get() : [];
        return view('profile.index',[
            'product' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function afterVerifyForm()
    {
        if(auth()->user()->name == '' || auth()->user()->name == null){
            return view('auth.after_verify');
        }
        return redirect('profile');
    }

    public function afterVerifyPost(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        auth()->user()->update([
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect('profile')->with('success', 'Selamat datang di ayosatset, belanja tampa ribet');
    }
}
