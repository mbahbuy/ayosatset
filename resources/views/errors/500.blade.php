@extends('layout.main',[
    'title' => 'Server Error'
])

@section('container')

<section class="error-part">
    <div class="container">
    <h1>500 | Server Error</h1>
    <img class="img-fluid" src="{{ asset('images/500.png') }}" alt="error">
    <h3>ooopps!</h3>
    <a href="{{ route('home') }}">go to home</a>
    </div>
</section>

@endsection

