@extends('auth.layout.main')

@section('auth')
    
<section class="user-form-part">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
        <div class="user-form-logo">
          <a href="{{ route('home') }}">
            <img src="{{ asset('images/logoipsum-221.svg') }}" alt="logo">
          </a>
        </div>
        <div class="user-form-card">
          <div class="user-form-title">
            <h2>any issue?</h2>
            <p>Make sure your current password is strong</p>
          </div>
          <form class="user-form">
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Old password">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Current password">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="reapet password">
            </div>
            <div class="form-button">
              <button type="submit">change password</button>
            </div>
          </form>
        </div>
        <div class="user-form-remind">
          <p>Go Back To <a href="login">login here</a>
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
