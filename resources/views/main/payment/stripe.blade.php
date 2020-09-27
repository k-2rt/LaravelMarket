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
          <div class="contact_form_title">お支払い方法</div>

          <form action="{{ route('payment.stripe') }}" method="post" id="payment-form">
            @csrf

            <div class="form-group">
              <ul class="logos_list">
                <li>
                  <input type="radio" name="payment_type" value="stripe">
                  <img src="{{ asset('/frontend/images/mastercard.png') }}" alt="" width="100px;" height="60px;">
                </li>

                <li>
                  <input type="radio" name="payment_type" value="paypal"><img src="{{ asset('/frontend/images/paypal.png') }}" alt="" width="100px;" height="60px;">
                </li>

                <li>
                  <input type="radio" name="payment_type" value="ideal"><img src="{{ asset('/frontend/images/mollie.png') }}" alt="" width="100px;" height="60px;">
                </li>

              </ul>
            </div>

            <div class="form-row">
              <label for="card-element">
                クレジットもしくはデビットカード
              </label>
              <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display form errors. -->
              <div id="card-errors" role="alert"></div>
            </div>
            <input type="hidden" name="shipping_fee" value="{{ $shipping_fee }}">
            <input type="hidden" name="total" value="{{ Cart::subtotal() + $shipping_fee }}">

            <div class="contact_form_button text-center">
              <button class="btn submit-btn font-weight-bold col-lg-5">支払う</button>
            </div>
          </form>
        </div>
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
