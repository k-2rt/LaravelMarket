@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_responsive.css') }}">

<div class="contact_form">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 login_form mx-auto">
        <div class="contact_form_container">
          <div class="contact_form_title">送付先住所</div>
          <form action="{{ route('update.shipping.address') }}" id="contact_form" method="POST">
            @csrf

            <div class="form-group">
              <label for="zip_code">郵便番号<span class="tx-danger">*</span></label>
              <input type="text" class="form-address" placeholder="例）1001000"  name="zip_code" required="" maxlength="7" value="{{ $user->zip_code }}">
            </div>

            <div class="form-group">
              <label for="prefectures">都道府県<span class="tx-danger">*</span></label>
              <select name="prefectures" id="" class="form-address" >
                @foreach ($prefs as $index => $name)
                  <option value="{{ $index }}" {{ $index == $user->prefectures ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="address1">住所１<span class="tx-danger">*</span></label>
              <input type="text" class="form-control" placeholder="市区町村番地"  name="address1" required="" value="{{ $user->address1 }}">
            </div>

            <div class="form-group">
              <label for="address2">住所２</label>
              <input type="text" class="form-control" placeholder="建物名" name="address2" value="{{ $user->address2 }}">
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
