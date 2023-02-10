<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from mironmahmud.com/greeny/assets/ltr/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jul 2022 05:26:08 GMT -->
  <!-- Added by HTTrack -->
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <!-- /Added by HTTrack -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="template" content="greeny">
    <meta name="title" content="greeny - Ecommerce Food Store HTML Template">
    <meta name="keywords" content="organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>Greeny - Register</title>
    <link rel="icon" href="images/favicon.png">
    <link rel="stylesheet" href="fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="fonts/icofont/icofont.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="vendor/venobox/venobox.min.css">
    <link rel="stylesheet" href="vendor/slickslider/slick.min.css">
    <link rel="stylesheet" href="vendor/niceselect/nice-select.min.css">
    <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/user-auth.css">
  </head>
  <body>
    <section class="user-form-part">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
            <div class="user-form-logo">
              <a href="index.html">
                <img src="images/logo.png" alt="logo">
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
                <p>Setup A New Account In A Minute</p>
              </div>
              <div class="user-form-group">
                <form class="user-form" method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Enter your name">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Enter your username">
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Enter your email">
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
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="check">
                    <label class="form-check-label" for="check">Accept all the <a href="#">Terms & Conditions</a>
                    </label>
                  </div>
                  <div class="form-button">
                    <button type="submit">register</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="user-form-remind">
              <p>Already Have An Account? <a href="{{ route('login') }}">login here</a>
              </p>
            </div>
            <div class="user-form-footer">
              <p>Greeny | &COPY; Copyright by <a href="#">Mironcoder</a>
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
    <script src="vendor/bootstrap/jquery-1.12.4.min.js"></script>
    <script src="vendor/bootstrap/popper.min.js"></script>
    <script src="vendor/bootstrap/bootstrap.min.js"></script>
    <script src="vendor/countdown/countdown.min.js"></script>
    <script src="vendor/niceselect/nice-select.min.js"></script>
    <script src="vendor/slickslider/slick.min.js"></script>
    <script src="vendor/venobox/venobox.min.js"></script>
    <script src="js/nice-select.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/accordion.js"></script>
    <script src="js/venobox.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/main.js"></script>
  </body>
  <!-- Mirrored from mironmahmud.com/greeny/assets/ltr/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jul 2022 05:26:08 GMT -->
</html>