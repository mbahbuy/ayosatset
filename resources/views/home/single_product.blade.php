@extends('layout.main')

@section('container')

<section class="inner-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="details-gallery">
            <div class="details-label-group">
              <label class="details-label new">new</label>
              {{-- <label class="details-label off">-10%</label> --}}
            </div>
            <ul class="details-preview">
              <li>
                <img src="{{ asset('assets' . '/' . $produk->image) }}" class="img-fluid" alt="product">
              </li>
            </ul>
            <ul class="details-thumb">
              <li>
                <img src="{{ asset('assets' . '/' . $produk->image) }}" class="img-fluid" alt="product">
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6">
          {{-- <ul class="product-navigation">
            <li class="product-nav-prev">
              <a href="#">
                <i class="icofont-arrow-left"></i>prev product <span class="product-nav-popup">
                  <img src="images/product/02.jpg" alt="product">
                  <small>green chilis</small>
                </span>
              </a>
            </li>
            <li class="product-nav-next">
              <a href="#">next product <i class="icofont-arrow-right"></i>
                <span class="product-nav-popup">
                  <img src="images/product/03.jpg" alt="product">
                  <small>green chilis</small>
                </span>
              </a>
            </li>
          </ul> --}}
          <div class="details-content">
            <h3 class="details-name">
                <p>{{ $produk->name }}</p>
            </h3>
            <div class="details-meta">
              <p>SKU: <span>1234567</span></p>
              <p>Penjual: <a href="{{ route('shop.show', $produk->shop->shop_hash) }}">{{ $produk->shop->name }}</a></p>
            </div>
            <div class="details-rating">
              <i class="active icofont-star"></i>
              <i class="active icofont-star"></i>
              <i class="active icofont-star"></i>
              <i class="active icofont-star"></i>
              <i class="icofont-star"></i>
              <a href="#">(3 reviews)</a>
            </div>
            <h3 class="details-price">
              <del>$38.00</del>
              <span>$24.00 <small>/per kilo</small>
              </span>
            </h3>
            <p class="details-desc">{!! Str::limit(strip_tags($produk->description), 150) !!}</p>
            <div class="details-list-group">
              <label class="details-list-title">tags:</label>
              <ul class="details-tag-list">
                <li>
                  <a href="#">organic</a>
                </li>
                <li>
                  <a href="#">fruits</a>
                </li>
                <li>
                  <a href="#">chilis</a>
                </li>
              </ul>
            </div>
            <div class="details-list-group">
              <label class="details-list-title">Share:</label>
              <ul class="details-share-list">
                <li>
                  <a href="#" class="icofont-facebook" title="Facebook"></a>
                </li>
                <li>
                  <a href="#" class="icofont-twitter" title="Twitter"></a>
                </li>
                <li>
                  <a href="#" class="icofont-linkedin" title="Linkedin"></a>
                </li>
                <li>
                  <a href="#" class="icofont-instagram" title="Instagram"></a>
                </li>
              </ul>
            </div>
            <div class="details-add-group">
              <button class="product-add" title="Add to Cart">
                <i class="fas fa-shopping-basket"></i>
                <span>add to cart</span>
              </button>
              <div class="product-action">
                <button class="action-minus" title="Quantity Minus">
                  <i class="icofont-minus"></i>
                </button>
                <input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
                <button class="action-plus" title="Quantity Plus">
                  <i class="icofont-plus"></i>
                </button>
              </div>
            </div>
            <div class="details-action-group">
              <a class="details-wish wish" href="#" title="Add Your Wishlist">
                <i class="icofont-heart"></i>
                <span>add to wish</span>
              </a>
              <a class="details-compare" href="compare.html" title="Compare This Item">
                <i class="fas fa-random"></i>
                <span>Compare This</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="inner-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="product-details-frame">
            <h3 class="frame-title">Description</h3>
            <div class="tab-descrip">
                {!! $produk->description !!}
            </div>
          </div>
          <div class="product-details-frame">
            <h3 class="frame-title">Spacification</h3>
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th scope="row">Product code</th>
                  <td>SKU: 101783</td>
                </tr>
                <tr>
                  <th scope="row">Weight</th>
                  <td>1kg, 2kg</td>
                </tr>
                <tr>
                  <th scope="row">Styles</th>
                  <td>@Girly</td>
                </tr>
                <tr>
                  <th scope="row">Properties</th>
                  <td>Short Dress</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="product-details-frame">
            <h3 class="frame-title">Reviews (2)</h3>
            <ul class="review-list">
              <li class="review-item">
                <div class="review-media">
                  <a class="review-avatar" href="#">
                    <img src="images/avatar/01.jpg" alt="review">
                  </a>
                  <h5 class="review-meta">
                    <a href="#">miron mahmud</a>
                    <span>June 02, 2020</span>
                  </h5>
                </div>
                <ul class="review-rating">
                  <li class="icofont-ui-rating"></li>
                  <li class="icofont-ui-rating"></li>
                  <li class="icofont-ui-rating"></li>
                  <li class="icofont-ui-rating"></li>
                  <li class="icofont-ui-rate-blank"></li>
                </ul>
                <p class="review-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus hic amet qui velit, molestiae suscipit perferendis, autem doloremque blanditiis dolores nulla excepturi ea nobis!</p>
                <form class="review-reply">
                  <input type="text" placeholder="reply your thoughts">
                  <button>
                    <i class="icofont-reply"></i>reply </button>
                </form>
                <ul class="review-reply-list">
                  <li class="review-reply-item">
                    <div class="review-media">
                      <a class="review-avatar" href="#">
                        <img src="images/avatar/02.jpg" alt="review">
                      </a>
                      <h5 class="review-meta">
                        <a href="#">labonno khan</a>
                        <span>
                          <b>author -</b>June 02, 2020 </span>
                      </h5>
                    </div>
                    <p class="review-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus hic amet qui velit, molestiae suscipit perferendis, autem doloremque blanditiis dolores nulla excepturi ea nobis!</p>
                    <form class="review-reply">
                      <input type="text" placeholder="reply your thoughts">
                      <button>
                        <i class="icofont-reply"></i>reply </button>
                    </form>
                  </li>
                  <li class="review-reply-item">
                    <div class="review-media">
                      <a class="review-avatar" href="#">
                        <img src="images/avatar/03.jpg" alt="review">
                      </a>
                      <h5 class="review-meta">
                        <a href="#">tahmina bonny</a>
                        <span>June 02, 2020</span>
                      </h5>
                    </div>
                    <p class="review-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus hic amet qui velit, molestiae suscipit perferendis, autem doloremque blanditiis dolores nulla excepturi ea nobis!</p>
                    <form class="review-reply">
                      <input type="text" placeholder="reply your thoughts">
                      <button>
                        <i class="icofont-reply"></i>reply </button>
                    </form>
                  </li>
                </ul>
              </li>
              <li class="review-item">
                <div class="review-media">
                  <a class="review-avatar" href="#">
                    <img src="images/avatar/04.jpg" alt="review">
                  </a>
                  <h5 class="review-meta">
                    <a href="#">shipu shikdar</a>
                    <span>June 02, 2020</span>
                  </h5>
                </div>
                <ul class="review-rating">
                  <li class="icofont-ui-rating"></li>
                  <li class="icofont-ui-rating"></li>
                  <li class="icofont-ui-rating"></li>
                  <li class="icofont-ui-rating"></li>
                  <li class="icofont-ui-rate-blank"></li>
                </ul>
                <p class="review-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus hic amet qui velit, molestiae suscipit perferendis, autem doloremque blanditiis dolores nulla excepturi ea nobis!</p>
                <form class="review-reply">
                  <input type="text" placeholder="reply your thoughts">
                  <button>
                    <i class="icofont-reply"></i>reply </button>
                </form>
              </li>
            </ul>
          </div>
          <div class="product-details-frame">
            <h3 class="frame-title">add your review</h3>
            <form class="review-form">
              <div class="row">
                <div class="col-lg-12">
                  <div class="star-rating">
                    <input type="radio" name="rating" id="star-1">
                    <label for="star-1"></label>
                    <input type="radio" name="rating" id="star-2">
                    <label for="star-2"></label>
                    <input type="radio" name="rating" id="star-3">
                    <label for="star-3"></label>
                    <input type="radio" name="rating" id="star-4">
                    <label for="star-4"></label>
                    <input type="radio" name="rating" id="star-5">
                    <label for="star-5"></label>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <textarea class="form-control" placeholder="Describe"></textarea>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="col-lg-12">
                  <button class="btn btn-inline">
                    <i class="icofont-water-drop"></i>
                    <span>drop your review</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('script')
    
@endsection