@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/cart_responsive.css') }}">

<!-- Cart -->

<div class="contact_form">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 mx-auto checkout_container">
        <div class="checkout_title">配送先・お届け日時のご指定をお願いいたします。</div>
        <form action="{{ route('confirm.page') }}" method="GET">
          @csrf

          <div class="checkout_form_container">
            <div class="checkout_form_title">送付先住所 <span class="address-section-link"><a href="{{ route('show.profile.page') }}">ご登録住所の変更</a></span></div>
            <div>
              <ul class="address_list">
                <li class="ship_address clearfix">
                  {{ $user->name }} 様
                </li>
                <li class="ship_address clearfix">
                  〒 {{ $user->hyphen_zip }}
                </li>
                <li class="ship_address clearfix">
                  {{ $user->pref_name }}　{{ $user->address1 }}
                </li>
                <li class="ship_address clearfix">
                  {{ $user->address2 }}
                </li>
              </ul>
            </div>
          </div>

          <div class="checkout_form_container">
            <div class="checkout_form_title">お届け希望日・時間帯</div>
            <div class="form-group d-flex justify-content-between">
              <div>
                <label for="delivery_date">希望日<span class="tx-danger">*</span></label>
                <select name="delivery_date" id="" class="form-address delivery_date" >
                  @foreach ($date['delivery_date'] as $key => $value)
                    <option value="{{ $key }}" {{ $key == old('delivery_date') ? 'selected' : '' }}>{{ $value }}</option>
                  @endforeach
                </select>
              </div>
              <div>
                <label for="delivery_time">時間帯<span class="tx-danger">*</span></label>
                <select name="delivery_time" id="" class="form-address delivery_time" >
                  @foreach ($date['delivery_time'] as $value)
                    <option value="{{ $value }}" {{ $value == old('delivery_time') ? 'selected' : '' }}>{{ $value }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="cart_buttons">
            <button class="button cart_button_clear" name="action" value="back">戻る</button>
            <button class="button cart_button_checkout" name="action" value="submit">ご注文の確認へ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
