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
          <form class="user-form" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" value="{{ old('email', $email) }}">
            </div>
            <div class="form-group">
              <div class="input-group flex-nowrap">
                <input type="password" class="form-control" id="pass" name="password" placeholder="Enter your password">
                <button type="button" onclick="password_show()" class="input-group-text" id="addon-wrapping"><i id="pass_icon" class="fa fa-eye-slash"></i></button>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group flex-nowrap">
                <input type="password" class="form-control" id="pass_conf" name="password_confirmation" placeholder="Enter repeat password">
                <button type="button" onclick="password_confirm_show()" class="input-group-text" id="addon-wrapping"><i id="pass_conf_icon" class="fa fa-eye-slash"></i></button>
              </div>
            </div>
            <div class="form-button">
              <button type="submit">save password</button>
            </div>
          </form>
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
