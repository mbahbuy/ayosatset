@extends('layout.main',[
    'title' => $exception->getMessage() ?:  'Forbidden'
])

@section('container')

<section class="error-part">
    <div class="container">
    <h1>403 | {{ $exception->getMessage() ?:  'Forbidden' }}</h1>
    <img class="img-fluid" src="images/403.jpg" alt="error">
    <h3>ooopps! Who Are You?</h3>
    <p>It looks like you can't to be here!</p>
    <a href="{{ route('home') }}">go to home</a>
    </div>
</section>

@endsection
