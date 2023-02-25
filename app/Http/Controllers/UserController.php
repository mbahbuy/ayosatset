<?php

namespace App\Http\Controllers;

use App\Models\{User,Product};
use Illuminate\Http\{Request};
use Illuminate\Support\Facades\{Hash, Validator, Storage};


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
        $rules = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required|image|file|max:2048'
        ]);
 
        if ($rules->fails()) {
            return back()->withInput()->withErrors($rules, 'profile_update');
        }
        $validatedData = $rules->validated();
        if($validatedData['name'] == '' || $validatedData['name'] == null || $validatedData['name'] == auth()->user()->name ){
            $validatedData['name'] = auth()->user()->name;
        }
        $validatedData['image'] = $request->file('image')->store('profile');
        if(auth()->user()->image !== null){
            Storage::delete(auth()->user()->image);
        }
        $user->update($validatedData);
        return back()->with('success', 'Profile has changed');
    }

    public function password(Request $request, User $user)
    {
        if($user->user_hash !== auth()->user()->user_hash){
            abort(403);
        }
        $rules = Validator::make( $request->all() , [
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        return $fail('Kata sandi lama tidak benar');
                    }
                },
            ],
            'new_password' => 'required|string|different:old_password',
            'password_confirmation' => 'required|string|same:new_password'
        ]);
        if($rules->fails()){
            return back()->withInput()->withErrors($rules, 'profile_password');
        }
        $validatedData = $rules->validated();
        $password = Hash::make($validatedData['new_password']);
        $user->update(['password' => $password]);
        return back()->with('success', 'Password has changed');
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

    public function users(){
        return view('dashboard.userslist',[
            'users' => User::where('admin_status', false)->get()
        ]);
    }
}
