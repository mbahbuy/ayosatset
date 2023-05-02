@extends('layout.main')

@section('container')
@php
    $productHash = $produk->product_hash;
@endphp
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
              <button class="product-add" onclick="cartAdd('{{ $productHash }}')" title="Add to Cart">
                <i class="fas fa-shopping-basket"></i>
                <span>add to cart</span>
              </button>
            </div>
            <div class="details-action-group">
              <a class="details-wish wish" style="cursor: pointer" onclick="wishToggle(this)" target-wish="{{ $productHash }}" title="Add Your Wishlist">
                <i class="icofont-heart"></i>
                <span>add to wish</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="inner-section reload-data">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <ul class="nav nav-tabs">
            <li>
              <button type="button" href="#tab-disc" class="tab-link active" data-bs-toggle="tab">Diskusi ({{ $produk->discuss->count() }})</button>
            </li>
            <li>
              <button type="button" href="#tab-reve" class="tab-link" data-bs-toggle="tab">Reviews ({{ $produk->ratings->count() }})</button>
            </li>
          </ul>
        </div>
      </div>
      <div class="tab-pane fade show active" id="tab-disc">
        <div class="row">
          <div class="col-lg-12">
            @if (sizeof($produk->discussion))
              <div class="product-details-frame">
                <ul class="review-list">
                  @foreach ($produk->discussion as $disc)                      
                  <li class="review-item">
                    <div class="review-media">
                      <a class="review-avatar">
                        <img src="{{ $disc->user->image ? asset('assets') . '/' . $disc->user->image : asset('images/user.png') }}" alt="">
                      </a>
                      <h5 class="review-meta">
                        <a >{{ $disc->user->name }}</a>
                        <span>{{ Carbon\Carbon::parse($disc->created_at)->diffInHours(now()) < 24 ? Carbon\Carbon::parse($disc->created_at)->diffForHumans() : Carbon\Carbon::parse($disc->created_at)->translatedFormat('l, d F Y') }}</span>
                      </h5>
                    </div>
                    <p class="review-desc">{!! $disc->message !!}</p>
                    @if (sizeof($disc->children))
                      <ul class="review-reply-list">
                        @foreach ($disc->children as $child)                            
                          <li class="review-reply-item">
                            <div class="review-media">
                              <a class="review-avatar">
                                <img src="{{ $child->user->shop && $child->user->shop->shop_hash == $produk->shop->shop_hash ? ($produk->shop->image ? asset('assets') . '/' . $produk->shop->image : asset('images/brand/02.jpg')) : ($child->user->image ? asset('assets') . '/' . $child->user->image : asset('images/user.png')) }}" alt="">
                              </a>
                              <h5 class="review-meta">
                                <a >{{ $child->user->shop && $child->user->shop->shop_hash == $produk->shop->shop_hash ? $child->user->shop->name : $child->user->name }}</a>
                                <span>{{ Carbon\Carbon::parse($child->created_at)->diffInHours(now()) < 24 ? Carbon\Carbon::parse($child->created_at)->diffForHumans() : Carbon\Carbon::parse($child->created_at)->translatedFormat('l, d F Y') }}</span>
                              </h5>
                            </div>
                            <p class="review-desc">{!! $child->message !!}</p>
                          </li>
                        @endforeach
                        @auth                            
                          <li class="review-reply-item">
                            <div class="review-reply">
                              <textarea class="form-control text-bg-light discuss h-25" placeholder="Tanya aja.." onkeyup="btnAble(this)" onfocus="showButton(this)"></textarea>
                              <button class="btn btn-inline discuss-push visually-hidden" type="button" data-product="{{ $productHash }}" data-parent="{{ $disc->discussion_hash }}" onclick="pushDiscussion(this)" disabled>
                                <i class="icofont-reply"></i>
                                <span>Jawab</span>
                              </button>
                            </div>
                          </li>
                          @else
                          <li class="text-center">Anda harus login dulu!</li>
                        @endauth
                      </ul>
                    @else
                      @auth                         
                        <div class="review-reply">
                          <textarea class="form-control text-bg-light discuss h-25" placeholder="Tanya aja.." onkeyup="btnAble(this)" onfocus="showButton(this)"></textarea>
                          <button class="btn btn-inline discuss-push visually-hidden" type="button" data-product="{{ $productHash }}" data-parent="{{ $disc->discussion_hash }}" onclick="pushDiscussion(this)" disabled>
                            <i class="icofont-reply"></i>
                            <span>Jawab</span>
                          </button>
                        </div>
                      @else
                        <div class="text-center">Anda harus login dulu!</div>
                      @endauth
                    @endif
                  </li>
                  @endforeach
                </ul>
              </div>
            @endif
            @auth
              @if (auth()->user()->shop == false || (auth()->user()->shop && auth()->user()->shop->shop_hash !== $produk->shop->shop_hash))
                <div class="product-details-frame">
                  <h3 class="frame-title">Tanya Penjual</h3>
                  <div class="review-form">
                    <div class="row">
                      <div class="col-lg-12">          
                        <div class="form-group">
                          <textarea class="form-control" placeholder="Tanya aja.." onkeyup="btnAble(this)"></textarea>
                          <button class="btn btn-inline" type="button" data-product="{{ $productHash }}" data-parent="" onclick="pushDiscussion(this)" disabled>
                            <i class="icofont-water-drop"></i>
                            <span>kirim pertanyaan</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @else
              <div class="product-details-frame">
                <div class="text-center">Anda harus login dulu!</div>
              </div>
            @endauth
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="tab-reve">
        @if ( sizeof($produk->ratings) )
          <div class="row">
            <div class="col-lg-12">
              <div class="product-details-frame">
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
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @else
          <div class="text-center">Belum ada reviews</div>
        @endif
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

  @auth
    $('body').click(function(e) {
      if (!$(e.target).is('textarea.discuss') && !$(e.target).is('button.discuss-push')) {
        $('textarea.discuss').addClass("h-25");
        $('textarea.discuss').val(null);
        $('button.discuss-push').addClass("visually-hidden");
        $('button.discuss-push').prop("disabled", true);
      }
    });
    function showButton(btn) {
      var btntar = $(btn).next('button.btn');
      $(btn).removeClass("h-25");
      btntar.removeClass("visually-hidden");
    }

    function btnAble(btn) {
      if ($(btn).val().length == 0) {
        $(btn).next('button.btn').prop("disabled", true);
      } else {
        $(btn).next('button.btn').prop("disabled", false);
      }
    }

    function pushDiscussion(hub) {
      var parent = $(hub).attr('data-parent');
      var product = $(hub).attr('data-product');
      var message = $(hub).prev('textarea.form-control').val();
      $.ajax({
        url:"{{ route('discuss.store') }}",
        method: 'POST',
        dataType: 'json',
        data: {
          '_token': '{{ csrf_token() }}',
          'parent': parent,
          'product_hash': product,
          'message': message
        },
        success: function (response) {
          $( ".reload-data" ).load(window.location.href + " .reload-data>" );
          showAlertPopUp(response.data);
        }
      });
    }
      
  @endauth
</script>
@endsection