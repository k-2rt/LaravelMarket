@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/product_responsive.css') }}">

<!-- Single Product -->

<div class="single_product">
  <div class="container">
    <div class="row">
      <!-- Images -->
      <div class="col-lg-2 order-lg-1 order-2">
        <ul class="image_list">
            <li data-image="{{ asset( $product->image_one ) }}"><img src="{{ asset( $product->image_one ) }}" alt=""></li>
            @if ($product->image_two)
              <li data-image="{{ asset( $product->image_two ) }}"><img src="{{ asset( $product->image_two ) }}" alt=""></li>
            @endif

            @if ($product->image_three)
              <li data-image="{{ asset( $product->image_three ) }}"><img src="{{ asset( $product->image_three ) }}" alt=""></li>
            @endif
        </ul>
      </div>

      <!-- Selected Image -->
      <div class="col-lg-5 order-lg-2 order-1">
        <div class="image_selected"><img src="{{ asset( $product->image_one ) }}" alt=""></div>
      </div>

      <!-- Description -->
      <div class="col-lg-5 order-3">
        <div class="product_description">
          <div class="product_category"> <a href="{{ route('show.category.list', ['id' => $product->category->id]) }}">{{ $product->category->category_name }}</a>  >  <a href="{{ route('show.subcategory.list', ['id' => $product->subcategory->id]) }}">{{ $product->subcategory->subcategory_name }}</a></div>
          <div class="product_brand">{{ $product->brand->brand_name }}</div>
          <div class="product_name">{{ $product->product_name }}</div>
          <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
          <div class="product_text">
              <p>{!! Str::limit($product->product_details, 500) !!}</p>
          </div>
          <div class="order_info d-flex flex-row">
            <form action="{{ route('add.product.cart', ['id' => $product->id]) }}" method="POST">
            @csrf

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="exampleFormControlSelect1" class="product_label">カラー</label>
                    <select class="product_form_control" id="exampleFormControlSelect1" name="color">
                      @foreach ($colors as $color)
                        <option value="{{ $color }}">{{ $color }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                @if (!empty($product->product_size))
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="exampleFormControlSelect2" class="product_label">サイズ</label>
                      <select class="product_form_control input-lg" id="exampleFormControlSelect2" name="size">
                        @foreach ($sizes as $size)
                          <option value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                @endif

                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="exampleFormControlSelect3" class="product_label">数量</label>
                    <input type="number" class="product_form_control product_number" id="exampleFormControlSelect3" name="qty" value="1" pattern="[0-9]" min="1" max="10">
                  </div>
                </div>
              </div>

              <div class="product_wish">
                @auth
                  @if ($product->current_user_wish->count() > 0)
                    <button type="button" class="button wish_button addWishList" data-id="{{ $product->id }}" style="background: #c3c3c3;">ほしい物リストから削除</button>
                  @else
                    <button type="button" class="button wish_button addWishList" data-id="{{ $product->id }}">ほしい物リストに追加</button>
                  @endif
                @endauth
              </div>

              <div class="product_price">
                @if($product->discount_price === NULL)
                  {{ number_format($product->selling_price) }}円
                @else
                  {{ number_format($product->discount_price) }}円<span>{{ number_format($product->selling_price) }}円</span>
                @endif
                <button type="submit" class="button cart_button">カートに入れる</button>
              </div>

              <br />
              <br />
              <!-- Go to www.addthis.com/dashboard to customize your tools -->
              <div class="addthis_inline_share_toolbox"></div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Recently Viewed -->

<div class="viewed">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="viewed_title_container">
          <h3 class="viewed_title">商品詳細</h3>
          <div class="viewed_nav_container">
            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
          </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">詳細</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ビデオURL</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">レビュー</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br />{!! $product->product_details !!}</div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br />{{ $product->video_link }}</div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><br />
          <div class="fb-comments" data-href="{{ Request::url() }}" data-numposts="5" data-width=""></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v8.0" nonce="KTfXE5tJ"></script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f7dde425645ff14"></script>


@endsection
