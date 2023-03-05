@extends('layout.main',[
    'title' => 'Page Expired'
])

@section('container')

<section class="error-part">
    <div class="container">
    <h1>419 | Page Expired</h1>
    <img class="img-fluid" src="{{ asset('images/419.png') }}" alt="error">
    <h3>ooopps!</h3>
    <a href="{{ route('home') }}">go to home</a>
    </div>
</section>

@endsection

