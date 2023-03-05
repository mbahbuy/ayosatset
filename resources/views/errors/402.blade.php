@extends('layout.main',[
    'title' => $exception->getMessage() ?:  'Payment Required'
])

@section('container')

<section class="error-part">
    <div class="container">
    <h1>402 | {{ $exception->getMessage() ?:  'Payment Required' }}</h1>
    <img class="img-fluid" src="{{ asset('images/402.jpg') }}" alt="error">
    <h3>ooopps! You need to be a VIP?</h3>
    <p>It looks like you can't to be here!</p>
    <a href="{{ route('home') }}">go to home</a>
    </div>
</section>

@endsection
