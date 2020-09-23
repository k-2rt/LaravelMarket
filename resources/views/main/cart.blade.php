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
          <div class="cart_title">カートに入っている商品 ({{ Cart::count() }}点)</div>
          <div class="cart_items">
            <ul class="cart_list">

              @foreach ($cart as $item)
                <li class="cart_item clearfix">
                <div class="cart_item_image text-center"><img src="{{ asset( $item->options->image  ) }}" alt="" height="115px" width="115px"></div>
                  <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                    <div class="cart_item_name cart_info_col">
                      <div class="cart_item_title">商品名</div>
                      <div class="cart_item_text">{{ $item->name }}</div>
                    </div>

                    @if ($item->options->color)
                      <div class="cart_item_color cart_info_col">
                        <div class="cart_item_title">カラー</div>
                        <div class="cart_item_text">{{ $item->options->color }}</div>
                      </div>
                    @endif

                    @if ($item->options->size)
                      <div class="cart_item_color cart_info_col">
                        <div class="cart_item_title">サイズ</div>
                        <div class="cart_item_text">{{ $item->options->size }}</div>
                      </div>
                    @endif

                    <div class="cart_item_price cart_info_col">
                      <div class="cart_item_title">価格</div>
                      <div class="cart_item_text">{{ number_format($item->price) }}円</div>
                    </div>

                    <div class="cart_item_quantity cart_info_col">
                      <div class="cart_item_title">数量</div>
                      <div class="cart_item_text">
                        <form action="{{ route('update.cart.item') }}" method="POST">
                          @csrf
                          <input type="hidden" name="product_id" value="{{ $item->rowId }}">
                          <input type="number" name="qty" value="{{ $item->qty }}" style="width:50px;">
                          <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-check-square"></i></button>
                        </form>
                      </div>
                    </div>


                    <div class="cart_item_quantity cart_info_col">
                      <div class="cart_item_title">削除</div>
                      <div class="cart_item_text"><a href="{{ route('remove.cart.item', ['rowId' => $item->rowId]) }}" class="btn btn-sm btn-secondary button-circle">X</a></div>

                    </div>

                  </div>
                </li>

              @endforeach
            </ul>
          </div>

          <!-- Order Total -->
          <div class="order_total">
            <div class="order_total_content text-md-right">
              <div class="order_total_title">商品合計(税込)</div>
            <div class="order_total_amount">{{ Cart::total() }}円</div>
            </div>
          </div>

          <div class="cart_buttons">
            <button type="button" class="button cart_button_clear">キャンセル</button>
            <a href="{{ route('checkout.product') }}" class="button cart_button_checkout">購入画面へ</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <script src="{{ asset('/frontend/js/cart_custom.js') }}"></script> --}}

@endsection
