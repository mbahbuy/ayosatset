@extends('layout.main')

@section('container')

<section class="inner-section checkout-part">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <div class="account-card">
              <div class="account-title">
                <h4>Alamat pengiriman</h4>
                <button data-bs-toggle="modal" data-bs-target="#address-add">add address</button>
              </div>
              <div class="account-content">
                <div class="row">
                  <div class="col-md-6 col-lg-4 alert fade show">
                    <div class="profile-card address active">
                      <h6>Home</h6>
                      <p>jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A</p>
                      <ul class="user-action">
                        <li>
                          <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#address-edit"></button>
                        </li>
                        <li>
                          <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 alert fade show">
                    <div class="profile-card address">
                      <h6>Office</h6>
                      <p>east tejturi bazar, dhaka-1200. word no-04, road no-13/c, house no-4/b</p>
                      <ul class="user-action">
                        <li>
                          <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#address-edit"></button>
                        </li>
                        <li>
                          <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 alert fade show">
                    <div class="profile-card address">
                      <h6>Bussiness</h6>
                      <p>kawran bazar, dhaka-1100. word no-02, road no-13/d, house no-7/m</p>
                      <ul class="user-action">
                        <li>
                          <button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#address-edit"></button>
                        </li>
                        <li>
                          <button class="trash icofont-ui-delete" title="Remove This" data-bs-dismiss="alert"></button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-12">
          <div class="account-card">
            <div class="account-title">
              <h4>Your order</h4>
            </div>
            <div class="account-content">
              <div class="table-scroll">
                <table class="table-list">
                  <thead>
                    <tr>
                      <th scope="col">Serial</th>
                      <th scope="col">Product</th>
                      <th scope="col">Name</th>
                      <th scope="col">Price</th>
                      <th scope="col">brand</th>
                      <th scope="col">quantity</th>
                      <th scope="col">action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="table-serial">
                        <h6>01</h6>
                      </td>
                      <td class="table-image">
                        <img src="images/product/01.jpg" alt="product">
                      </td>
                      <td class="table-name">
                        <h6>product name</h6>
                      </td>
                      <td class="table-price">
                        <h6>$19 <small>/kilo</small>
                        </h6>
                      </td>
                      <td class="table-brand">
                        <h6>Fresh Company</h6>
                      </td>
                      <td class="table-quantity">
                        <h6>3</h6>
                      </td>
                      <td class="table-action">
                        <a class="view" href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#product-view">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a class="trash" href="#" title="Remove Wishlist">
                          <i class="icofont-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="table-serial">
                        <h6>02</h6>
                      </td>
                      <td class="table-image">
                        <img src="images/product/02.jpg" alt="product">
                      </td>
                      <td class="table-name">
                        <h6>product name</h6>
                      </td>
                      <td class="table-price">
                        <h6>$19 <small>/kilo</small>
                        </h6>
                      </td>
                      <td class="table-brand">
                        <h6>Radhuni Masala</h6>
                      </td>
                      <td class="table-quantity">
                        <h6>5</h6>
                      </td>
                      <td class="table-action">
                        <a class="view" href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#product-view">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a class="trash" href="#" title="Remove Wishlist">
                          <i class="icofont-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="table-serial">
                        <h6>03</h6>
                      </td>
                      <td class="table-image">
                        <img src="images/product/03.jpg" alt="product">
                      </td>
                      <td class="table-name">
                        <h6>product name</h6>
                      </td>
                      <td class="table-price">
                        <h6>$19 <small>/kilo</small>
                        </h6>
                      </td>
                      <td class="table-brand">
                        <h6>Pran Prio</h6>
                      </td>
                      <td class="table-quantity">
                        <h6>2</h6>
                      </td>
                      <td class="table-action">
                        <a class="view" href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#product-view">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a class="trash" href="#" title="Remove Wishlist">
                          <i class="icofont-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="table-serial">
                        <h6>04</h6>
                      </td>
                      <td class="table-image">
                        <img src="images/product/04.jpg" alt="product">
                      </td>
                      <td class="table-name">
                        <h6>product name</h6>
                      </td>
                      <td class="table-price">
                        <h6>$19 <small>/kilo</small>
                        </h6>
                      </td>
                      <td class="table-brand">
                        <h6>Real Food</h6>
                      </td>
                      <td class="table-quantity">
                        <h6>3</h6>
                      </td>
                      <td class="table-action">
                        <a class="view" href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#product-view">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a class="trash" href="#" title="Remove Wishlist">
                          <i class="icofont-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td class="table-serial">
                        <h6>05</h6>
                      </td>
                      <td class="table-image">
                        <img src="images/product/05.jpg" alt="product">
                      </td>
                      <td class="table-name">
                        <h6>product name</h6>
                      </td>
                      <td class="table-price">
                        <h6>$19 <small>/kilo</small>
                        </h6>
                      </td>
                      <td class="table-brand">
                        <h6>Rdhuni Company</h6>
                      </td>
                      <td class="table-quantity">
                        <h6>7</h6>
                      </td>
                      <td class="table-action">
                        <a class="view" href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#product-view">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a class="trash" href="#" title="Remove Wishlist">
                          <i class="icofont-trash"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="chekout-coupon">
                <button class="coupon-btn">Do you have a coupon code?</button>
                <form class="coupon-form">
                  <input type="text" placeholder="Enter your coupon code">
                  <button type="submit">
                    <span>apply</span>
                  </button>
                </form>
              </div>
              <div class="checkout-charge">
                <ul>
                  <li>
                    <span>Sub total</span>
                    <span>$267.45</span>
                  </li>
                  <li>
                    <span>delivery fee</span>
                    <span>$10.00</span>
                  </li>
                  <li>
                    <span>discount</span>
                    <span>$00.00</span>
                  </li>
                  <li>
                    <span>Total <small>(Incl. VAT)</small>
                    </span>
                    <span>$277.00</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="account-card">
            <div class="account-title">
              <h4>Delivery Schedule</h4>
            </div>
            <div class="account-content">
              <div class="row">
                <div class="col-md-6 col-lg-4 alert fade show">
                  <div class="profile-card schedule active">
                    <h6>express</h6>
                    <p>90 min express delivery</p>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4 alert fade show">
                  <div class="profile-card schedule">
                    <h6>8am-10pm</h6>
                    <p>8.00 AM - 10.00 PM</p>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4 alert fade show">
                  <div class="profile-card schedule">
                    <h6>Next day</h6>
                    <p>Next day or Tomorrow</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<div class="modal fade" id="address-add">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <button class="modal-close" data-bs-dismiss="modal">
          <i class="icofont-close"></i>
        </button>
        <form class="modal-form">
          <div class="form-title">
            <h3>add new address</h3>
          </div>
          <div class="form-group">
            <label class="form-label">title</label>
            <select class="form-select">
              <option selected>choose title</option>
              <option value="home">home</option>
              <option value="office">office</option>
              <option value="Bussiness">Bussiness</option>
              <option value="academy">academy</option>
              <option value="others">others</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">address</label>
            <textarea class="form-control" placeholder="Enter your address"></textarea>
          </div>
          <button class="form-btn" type="submit">save address info</button>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="address-edit">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <button class="modal-close" data-bs-dismiss="modal">
          <i class="icofont-close"></i>
        </button>
        <form class="modal-form">
          <div class="form-title">
            <h3>edit address info</h3>
          </div>
          <div class="form-group">
            <label class="form-label">title</label>
            <select class="form-select">
              <option value="home" selected>home</option>
              <option value="office">office</option>
              <option value="Bussiness">Bussiness</option>
              <option value="academy">academy</option>
              <option value="others">others</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">address</label>
            <textarea class="form-control" placeholder="jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A"></textarea>
          </div>
          <button class="form-btn" type="submit">save address info</button>
        </form>
      </div>
    </div>
</div>

@endsection
@section('script')
    
@endsection