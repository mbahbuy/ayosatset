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
            <h2>Join Now!</h2>
            <p>Dapatkan email verifikasi buat daftar</p>
          </div>
          <div class="user-form-group">
            <form class="user-form" method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" value="{{ old('email') }}">
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="check">
                <label class="form-check-label" for="check">Accept all the <a href="#">Terms & Conditions</a>
                </label>
              </div>
              <div class="form-button">
                <button type="submit">Register</button>
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
<script>
  const pass = document.getElementById('pass');
  const pass_icon = document.getElementById('pass_icon');
  function password_show(){
    if(pass_icon.classList.contains('fa-eye-slash')){
      pass_icon.className = 'fa fa-eye';
      pass.setAttribute('type', 'text');
    } else {
      pass_icon.className = 'fa fa-eye-slash';
      pass.setAttribute('type', 'password');
    }
  }

  const pass_conf = document.getElementById('pass_conf');
  const pass_conf_icon = document.getElementById('pass_conf_icon');
  function password_confirm_show(){
    if(pass_conf_icon.classList.contains('fa-eye-slash')){
      pass_conf_icon.className = 'fa fa-eye';
      pass_conf.setAttribute('type', 'text');
    } else {
      pass_conf_icon.className = 'fa fa-eye-slash';
      pass_conf.setAttribute('type', 'password');
    }
  }

</script>

@endsection
