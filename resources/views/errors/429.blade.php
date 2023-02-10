@extends('layout.main',[
    'title' => 'Too Many Requests'
])

@section('container')

<section class="error-part">
    <div class="container">
    <h1>429 | Too Many Requests</h1>
    <img class="img-fluid" src="images/429.jpg" alt="error">
    <h3>ooopps!</h3>
    <a href="{{ route('home') }}">go to home</a>
    </div>
</section>

@endsection
