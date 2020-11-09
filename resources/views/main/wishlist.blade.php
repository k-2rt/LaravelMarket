@extends('layouts.app')

@section('content')
@include('layouts.menubar')

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
              @foreach ($wish_products as $wish)
                <li class="cart_item clearfix">
                <div class="cart_item_image text-center"><a href="{{ route('product.detail', ['id' => $wish->product->id, 'product_name' => $wish->product->product_name ]) }}"><img src="{{ Storage::disk('s3')->url( $wish->product->image_one  ) }}" alt="" height="115px" width="115px"></a></div>
                  <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                    <div class="cart_item_name cart_info_col wd-30p">
                      <div class="cart_item_title">商品名</div>
                      <div class="cart_item_text">{{ $wish->product->product_name }}</div>
                    </div>

                    <div class="cart_item_color cart_info_col wd-30p">
                      <div class="cart_item_title">カラー</div>
                      <div class="cart_item_text">{{ $wish->product->product_color }}</div>
                    </div>

                    <div class="cart_item_color cart_info_col wd-25p">
                      <div class="cart_item_title">サイズ</div>
                      <div class="cart_item_text">{{ $wish->product->product_size }}</div>
                    </div>

                    <div class="cart_item_color cart_info_col">
                      <div class="cart_item_title">削除</div>
                      <div class="cart_item_text">
                        <a href="{{ route('delete.wish.list', ['id' => $wish->id]) }}" class="btn btn-sm btn-secondary button-circle">X</a>
                      </div>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
