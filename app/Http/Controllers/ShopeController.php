<?php

namespace App\Http\Controllers;

use App\Models\Shope;
use Illuminate\Http\Request;

class ShopeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shope.index');
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
     * @param  \App\Models\Shope  $shope
     * @return \Illuminate\Http\Response
     */
    public function show(Shope $shope)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shope  $shope
     * @return \Illuminate\Http\Response
     */
    public function edit(Shope $shope)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shope  $shope
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shope $shope)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shope  $shope
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shope $shope)
    {
        //
    }
}
