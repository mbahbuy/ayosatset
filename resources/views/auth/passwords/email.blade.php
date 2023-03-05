@extends('auth.layout.main')

@section('auth')
    
<section class="user-form-part">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
        <div class="user-form-logo">
          <a href="{{ route('home') }}">
            <img src="{{ asset('images/logoipsum-221.svg') }}" alt="logo">
          </a>
        </div>
        <div class="user-form-card">
          @if ($errors->any())
            <div class="mt-n1 mb-3 text-center alert alert-danger alert-dismissible fade show" role="alert">
              {{ implode('', $errors->all(':message')) }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <div class="user-form-title">
            <h2>Reset password!</h2>
            <p>Dapatkan email untuk merubah sandi</p>
          </div>
          <div class="user-form-group">
            <form class="user-form" method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Enter your email">
              </div>
              <div class="form-button">
                <button type="submit">dapatkan</button>
              </div>
            </form>
          </div>
        </div>
        <div class="user-form-remind">
          <p>Sudah memiliki akun? <a href="{{ route('login') }}">login</a>
          </p>
        </div>
        <div class="user-form-footer">
          <p>Greeny | &COPY; Copyright by <a href="#">Verimer</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
