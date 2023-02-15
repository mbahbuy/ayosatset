@extends('layout.main')

@section('container')

<section class="error-part">
    <div class="container">
        <h1>You need to verify</h1>
        <h3>Check your email</h3>
        <a href="{{ route('home') }}">go to home</a>
    </div>
</section>

@endsection