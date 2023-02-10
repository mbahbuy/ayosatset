@extends('layout.main',[
    'title' => 'Service Unavailable'
])

@section('container')

<section class="error-part">
    <div class="container">
    <h1>503 | Service Unavailable</h1>
    <img class="img-fluid" src="images/503.png" alt="error">
    <h3>ooopps!</h3>
    <a href="{{ route('home') }}">go to home</a>
    </div>
</section>

@endsection


