@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/cart_responsive.css') }}">

<div class="contact_form">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 login_form mx-auto">
        <div class="checkout_title">ご注文内容を確認の上、カード情報を入力し「支払う」ボタンを押してください。</div>
        <form action="{{ route('payment.stripe') }}" method="POST" id="payment-form">
          @csrf

          <div class="cart_items">
            <ul class="cart_list">

              @foreach ($cart as $item)
                <li class="cart_item clearfix">
                  <div class="cart_checkout_image text-center"><img src="{{ asset( $item->options->image  ) }}" alt="" height="115px" width="115px"></div>

                  <div class="d-flex flex-column justify-content-between" style="height: 115px;">
                    <div class="cart_checkout_name cart_info_col">
                      <div class="cart_checkout_text">{{ $item->name }} / {{ $item->options->color }} / {{ $item->options->size }}</div>
                    </div>
                    <div class="cart_checkout_name cart_info_col">
                      <div class="cart_checkout_text">{{ number_format($item->price) }}円</div>
                      <div class="cart_item_quantity cart_info_col">
                        <div class="cart_checkout_text">
                          数量：{{ $item->qty }}
                        </div>
                      </div>
                  </div>
                </li>

              @endforeach
            </ul>
          </div>

          <!-- Order Total -->
          <div class="order_total_content clearfix" style="padding: 30px 0;">
            <ul class="list-group col-lg-12" style="float: right; padding-right: 0px;">
              <li class="list-group-item">商品合計<span style="float: right;">{{ number_format(Cart::Subtotal()) }}円</span></li>

              @if (Session::has('coupon'))
                <li class="list-group-item">クーポン ({{ Session::get('coupon')['name'] }})
                  <span style="float: right;">- {{ number_format(Session::get('coupon')['discount']) }}円</span>
                </li>
              @endif

              <li class="list-group-item">送料<span style="float: right;">{{ number_format($shipping_fee) }}円</span></li>
              <input type="hidden" name="shipping_fee" value="{{ $shipping_fee }}">
              @if (Session::has('coupon'))
                <li class="list-group-item">注文合計<span style="float: right;">{{ number_format(Cart::Subtotal() - Session::get('coupon')['discount'] + $shipping_fee) }}円</span></li>
              @else
                <li class="list-group-item">注文合計<span style="float: right;">{{ number_format(Cart::Subtotal() + $shipping_fee) }}円</span></li>
              @endif
            </ul>
          </div>

          <div class="checkout_form_container">
            <div class="checkout_form_title">送付先住所</div>
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
                <li class="ship_address clearfix">
                  電話番号：{{ $user->phone }}
                </li>
              </ul>
            </div>
          </div>

          <div class="checkout_form_container">
            <div class="checkout_form_title">お届け希望日・時間帯</div>
            <div class="form-group d-flex justify-content-between">
              <div>
                <label for="delivery_date">希望日<span class="tx-danger">*</span></label>
                <div class="form-address delivery_date">{{ $delivery_date }}</div>
              </div>
              <div>
                <label for="delivery_time">時間帯<span class="tx-danger">*</span></label>
                <div class="form-address delivery_time">{{ $delivery_time }}</div>
              </div>
            </div>
          </div>

          <div>
            <div class="contact_form_title">お支払い</div>

              <div class="form-row">
                <label for="card-element">
                  クレジットもしくはデビットカード
                </label>
                <div id="card-element" style="margin-bottom: 0.5rem;">
                  <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
              </div>

              <div class="contact_form_button text-center">
                <button class="btn submit-btn font-weight-bold col-lg-5" name="action" value="payment">支払う</button>
              </div>

              <div class="contact_form_button text-center">
                <button class="button confirm_back_button" onClick="history.back()">戻る</button>
              </div>
          </div>

          <input type="hidden" name="delivery_date" value="{{ $delivery_date_val }}">
          <input type="hidden" name="delivery_time" value="{{ $delivery_time }}">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Create a Stripe client.
var stripe = Stripe('{{$stripe}}');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    },
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  },
};

// Create an instance of the card Element.
var card = elements.create('card', {hidePostalCode: true, style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}

</script>

@endsection
