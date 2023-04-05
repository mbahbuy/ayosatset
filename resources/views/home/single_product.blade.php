@extends('layout.main')

@section('container')

<section class="inner-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="details-gallery">
            <div class="details-label-group">
              @if (Carbon\Carbon::parse($produk->created_at)->diffInWeeks(now()) <= 1)
                  <label class="details-label new">new</label>
              @else
                  <label class="label-text sale">sale</label>
              @endif
              {{-- <label class="details-label off">-10%</label> --}}
              {{-- <label class="label-text feat">feature</label> --}}
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
              {{-- <p>SKU: <span>1234567</span></p> --}}
              <p>Penjual: <a href="{{ route('shop.show', $produk->shop->shop_hash) }}">{{ $produk->shop->name }}</a></p>
            </div>
            <div class="details-rating">
              @php
                  $rating = $produk->ratings ? $produk->ratings->average('rating') : 0;
              @endphp
              <i class="{{ $rating >= 1 ? 'active' : '' }} icofont-star"></i>
              <i class="{{ $rating >= 2 ? 'active' : ''  }} icofont-star"></i>
              <i class="{{ $rating >= 3 ? 'active' : ''  }} icofont-star"></i>
              <i class="{{ $rating >= 4 ? 'active' : ''  }} icofont-star"></i>
              <i class="{{ $rating >= 5 ? 'active' : ''  }} icofont-star"></i>
              <a >({{ $produk->ratings ? $produk->ratings->count() : 0 }})</a>
            </div>
            <h3 class="details-price">
              {{-- <del>$38.00</del> --}}
              <span>Rp. {{ number_format($produk->price,0,',','.'); }}</span>
            </h3>
            <div class="details-desc"></div>
            <button class="link" type="button" onclick="toggleText(this)" data-full-text="{!! $produk->description !!}" data-sort-text="{!! Str::of($produk->description)->limit(150) !!}" data-toggle-text="more">Lihat Selengkapnya</button>
            {{-- <div class="details-list-group">
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
            </div> --}}
            {{-- <div class="details-list-group">
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
            </div> --}}
            <div class="details-add-group">
              <button class="product-add" onclick="cartAdd('{{ $produk->product_hash }}')" title="Add to Cart">
                <i class="fas fa-shopping-basket"></i>
                <span>add to cart</span>
              </button>
            </div>
            <div class="details-action-group">
              <a class="details-wish wish" style="cursor: pointer" onclick="wishToggle(this)" target-wish="{{ $produk->product_hash }}" title="Add Your Wishlist">
                <i class="icofont-heart"></i>
                <span>add to wish</span>
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
          {{-- <div class="product-details-frame">
            <h3 class="frame-title">Description</h3>
            <div class="tab-descrip">
                {!! $produk->description !!}
            </div>
          </div> --}}
          {{-- <div class="product-details-frame">
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
          </div> --}}
          <div class="product-details-frame">
            @if ($produk->ratings)
              <h3 class="frame-title">Reviews ({{ $produk->ratings->count() }})</h3>
              <ul class="review-list">
                @foreach ($produk->ratings as $item)                    
                  <li class="review-item">
                    <div class="review-media">
                      <a class="review-avatar">
                        <img src="{{ $item->user->image ? asset('assets') . '/' . $item->user->image : asset('images/user.png') }}" alt="review">
                      </a>
                      <h5 class="review-meta">
                        <a >{{ $item->user->name }}</a>
                        <span>{{ Carbon\Carbon::parse($item->created_at)->diffInHours(now()) < 24 ? Carbon\Carbon::parse($item->created_at)->diffForHumans() : Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</span>
                      </h5>
                    </div>
                    <ul class="review-rating">
                      @php
                          $rating = $item->ratings ? $item->ratings->average('rating') : 0;
                      @endphp
                      <i class="{{ $rating >= 1 ? 'icofont-ui-rating' : 'icofont-ui-rate-blank' }}"></i>
                      <i class="{{ $rating >= 2 ? 'icofont-ui-rating' : 'icofont-ui-rate-blank'  }}"></i>
                      <i class="{{ $rating >= 3 ? 'icofont-ui-rating' : 'icofont-ui-rate-blank'  }}"></i>
                      <i class="{{ $rating >= 4 ? 'icofont-ui-rating' : 'icofont-ui-rate-blank'  }}"></i>
                      <i class="{{ $rating >= 5 ? 'icofont-ui-rating' : 'icofont-ui-rate-blank'  }}"></i>
                    </ul>
                    <p class="review-desc">{!! $item->message !!}</p>
                    {{-- <ul class="review-reply-list">
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
                    </ul> --}}
                  </li>
                @endforeach
              </ul>
            @else
              <h3 class="frame-title">Reviews (0)</h3>
              <div class="review-list">Belum ada review</div>
            @endif
          </div>
          {{-- <div class="product-details-frame">
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
          </div> --}}
        </div>
      </div>
    </div>
  </section>

@endsection
@section('script')
<script>

  var target = $(".details-desc");
  var sortText = target.next('button.link').attr('data-sort-text');
  target.html(sortText);

  function toggleText(par) {
    var textContainer = $('.details-desc');
    var fullText = $(par).attr('data-full-text');
    var sortText = $(par).attr('data-sort-text');
    var dataToggle = $(par).attr('data-toggle-text');
    if (dataToggle == 'more') {
      textContainer.html(fullText);
      $(par).html('Lihat Lebih Sedikit');
      $(par).attr('data-toggle-text', 'sort');
    } else {
      textContainer.html(sortText);
      $(par).html('Lihat Selengkapnya');
      $(par).attr('data-toggle-text', 'more');
    }
  };

</script>
@endsection