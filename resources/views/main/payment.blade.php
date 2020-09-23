@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_responsive.css') }}">

<div class="contact_form">
  <div class="container">
    <div class="row">

      <div class="col-lg-7 login_form mx-auto">
        <div class="contact_form_container">
          <div class="contact_form_title">送付先住所</div>
        <form action="{{ route('process.payment') }}" id="contact_form" method="POST">
          @csrf
            <div class="form-group">
              <label for="name">フルネーム<span class="tx-danger">*</span></label>
              <input type="text" class="form-control" placeholder="フルネームを入力してください"  name="name" required="">
            </div>

            <div class="form-group">
              <label for="phone">電話番号<span class="tx-danger">*</span></label>
              <input type="text" class="form-control" placeholder="電話番号を入力してください"  name="phone" required="">
            </div>

            <div class="form-group">
              <label for="email">メールアドレス<span class="tx-danger">*</span></label>
              <input type="email" class="form-control" placeholder="メールアドレスを入力してください"  name="email" required="">
            </div>

            <div class="form-group">
              <label for="prefecture">都道府県<span class="tx-danger">*</span></label>
              <input type="text" class="form-control" placeholder="住所を入力してください"  name="prefecture" required="">
            </div>

            <div class="form-group">
              <label for="address">市区町村番地<span class="tx-danger">*</span></label>
              <input type="text" class="form-control" placeholder="市区町村番地を入力してください"  name="address" required="">
            </div>

            <div class="form-group">
              <label for="building">建物名</label>
              <input type="text" class="form-control" placeholder="建物名を入力してください"  name="building">
            </div>

            <div class="contact_form_title_next">お支払い方法</div>

            <div class="form-group">
              <ul class="logos_list">
                <li>
                <input type="radio" name="payment" value="stripe"><img src="{{ asset('/frontend/images/mastercard.png') }}" alt="" width="100px;" height="60px;">
                </li>

                <li>
                  <input type="radio" name="payment" value="paypal"><img src="{{ asset('/frontend/images/paypal.png') }}" alt="" width="100px;" height="60px;">
                </li>

                <li>
                  <input type="radio" name="payment" value="ideal"><img src="{{ asset('/frontend/images/mollie.png') }}" alt="" width="100px;" height="60px;">
                </li>

              </ul>
            </div>

            <div class="contact_form_button text-center">
              <button type="submit" class="btn submit-btn font-weight-bold col-lg-5">住所を登録</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
