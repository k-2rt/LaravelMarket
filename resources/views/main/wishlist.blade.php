@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/cart_responsive.css') }}">

<!-- Cart -->

<div class="cart_section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="cart_container">
          <div class="cart_title">ほしい物リスト</div>
          <div class="cart_items">
            <ul class="cart_list">

              @foreach ($products as $product)
                <li class="cart_item clearfix">
                <div class="cart_item_image text-center"><img src="{{ asset( $product->image_one  ) }}" alt="" height="115px" width="115px"></div>
                  <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                    <div class="cart_item_name cart_info_col">
                      <div class="cart_item_title">商品名</div>
                      <div class="cart_item_text">{{ $product->product_name }}</div>
                    </div>

                    <div class="cart_item_color cart_info_col">
                      <div class="cart_item_title">カラー</div>
                      <div class="cart_item_text">{{ $product->productcolor }}</div>
                    </div>

                    <div class="cart_item_color cart_info_col">
                      <div class="cart_item_title">サイズ</div>
                      <div class="cart_item_text">{{ $product->product_size }}</div>
                    </div>

                    <div class="cart_item_color cart_info_col">
                      <div class="cart_item_title">アクション</div>
                      <div class="cart_item_text">
                        <a href="" class="btn btn-sm btn-primary">カートに入れる</a>
                      </div>
                    </div>

                  </div>
                </li>

              @endforeach
            </ul>
          </div>

          {{-- <div class="cart_buttons">
            <button type="button" class="button cart_button_clear">キャンセル</button>
            <a href="{{ route('checkout.product') }}" class="button cart_button_checkout">購入する</a>
          </div> --}}

        </div>
      </div>
    </div>
  </div>
</div>

{{-- <script src="{{ asset('/frontend/js/cart_custom.js') }}"></script> --}}

@endsection
