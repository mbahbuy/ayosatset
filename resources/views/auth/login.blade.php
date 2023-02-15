@extends('auth.layout.main')

@section('auth')
    
<section class="user-form-part">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
        <div class="user-form-logo">
          <a href="{{ route('home') }}">
            <img src="/images/logo.png" alt="logo">
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
            <h2>welcome!</h2>
            <p>Use your credentials to access</p>
          </div>
          <div class="user-form-group">
            <form class="user-form" action="{{ route('login') }}" method="POST">
              @csrf
              <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" value="{{ old('email') }}">
              </div>
              <div class="form-group">
                <div class="input-group flex-nowrap">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="pass" name="password" placeholder="Enter your password" value="{{ old('password') }}">
                  <button type="button" onclick="password_show()" class="input-group-text" id="addon-wrapping"><i id="pass_icon" class="fa fa-eye-slash"></i></button>
                </div>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Remember Me</label>
              </div>
              <div class="form-button">
                <button type="submit">login</button>
                <p>Lupa sandi? <a href="{{ route('password.request') }}">rubah sandi</a>
                </p>
              </div>
            </form>
          </div>
        </div>
        <div class="user-form-remind">
          <p>Belum memiliki akun? <a href="{{ route('register') }}">Daftar sekarang</a>
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
</script>

@endsection
