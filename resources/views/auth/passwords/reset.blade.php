<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from mironmahmud.com/greeny/assets/ltr/change-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jul 2022 05:26:08 GMT -->
  <!-- Added by HTTrack -->
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <!-- /Added by HTTrack -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="template" content="greeny">
    <meta name="title" content="greeny - Ecommerce Food Store HTML Template">
    <meta name="keywords" content="organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>Greeny - Change Password</title>
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
          <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <div class="user-form-logo">
              <a href="index.html">
                <img src="images/logo.png" alt="logo">
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
              <p>Greeny | &COPY; Copyright by <a href="#">Mironcoder</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
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
  <!-- Mirrored from mironmahmud.com/greeny/assets/ltr/change-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jul 2022 05:26:08 GMT -->
</html>