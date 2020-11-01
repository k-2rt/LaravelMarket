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
          @if ($cart->isNotEmpty())
            <div class="cart_title">カートに入っている商品 ({{ Cart::count() }}点)</div>
            <div class="cart_items">
              <ul class="cart_list">
                @foreach ($cart as $item)
                  <li class="cart_item clearfix">
                    <div class="cart_item_image text-center"><a href="{{ route('product.detail', ['id' => $item->id, 'product_name' => $item->name]) }}"><img src="{{ asset( $item->options->image  ) }}" alt="" height="115px" width="115px"></a></div>
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
                            <input type="number" name="qty" value="{{ $item->qty }}" style="width:50px;" min="1" max="10">
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

            <div class="order_total_content clearfix" style="padding: 30px 0;">
              <h5>クーポンコード</h5>
              <form action="{{ route('apply.coupon') }}" method="POST" style="display: inline-block;">
              @csrf
                <div class="form-group">
                  <input type="text" name="coupon" class="coupon-form" required="" placeholder="">
                  <button type="submit" class="btn btn-danger ml-2">適用</button>
                </div>
              </form>

              <ul class="list-group col-lg-6" style="float: right; padding-right: 0px;">
                <li class="list-group-item">商品合計（税込）<span style="float: right;">{{ number_format(Cart::Subtotal()) }}円</span></li>

                @if (Session::has('coupon'))
                  <li class="list-group-item">クーポン ({{ Session::get('coupon')['name'] }})
                  <a href="{{ route('remove.coupon') }}" class="btn btn-secondary btn-sm button-circle">X</a>
                    <span style="float: right;">- {{ number_format(Session::get('coupon')['discount']) }}円</span>
                  </li>
                @else
                  <li class="list-group-item">クーポン
                    <span style="float: right;">なし</span>
                  </li>
                @endif

                <li class="list-group-item">送料<span style="float: right;">{{ number_format($shipping_fee) }}円</span></li>

                @if (Session::has('coupon'))
                  <li class="list-group-item">注文合計<span style="float: right;">{{ number_format(Cart::Subtotal() - Session::get('coupon')['discount'] + $shipping_fee) }}円</span></li>
                @else
                  <li class="list-group-item">注文合計<span style="float: right;">{{ number_format(Cart::Subtotal() + $shipping_fee) }}円</span></li>
                @endif

              </ul>
            </div>
            <div class="cart_buttons">
              <button type="button" class="button cart_button_clear">キャンセル</button>
              <a href="{{ route('checkout.product') }}" class="button cart_button_checkout">ご購入手続きへ</a>
            </div>
          </div>
        @else
          <div class="cart_title" style='text-align: center;'>商品はありません。</div>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
