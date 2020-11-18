@extends('layouts.app')

@section('content')

<div class="contact_form">
  <div class="container">
    <div class="row">

      <div class="col-5 offset-lg-1">
        <div class="contact_form_title">
          <h4></h4>
          @if ($order->status === '0')
            <h4>注文状況：承認待ち</h4>
          @elseif ($order->status === '1')
            <h4>注文状況：お支払いが承認されました</h4>
          @elseif ($order->status === '2')
            <h4>注文状況：配達中です</h4>
          @elseif ($order->status === '3')
            <h4>注文状況：送付先に商品が到着しました</h4>
          @else
            <h4>注文状況：注文はキャンセルされました</h4>
          @endif
        </div><br />

        <div class="progress">

          @if ($order->status === '0')
            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
          @elseif ($order->status === '1')
            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
          @elseif ($order->status === '2')
            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          @elseif ($order->status === '3')
            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          @else
            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
          @endif

        </div>
      </div>

      <div class="col-5 offset-lg-1">
        <div class="contact_form_title">
          <h4>注文詳細</h4>
        </div>
        <ul class="list-group col-lg-12">
          <li class="list-group-item"><b>注文日</b>：<span style="float: right;"> {{ $order->order_date }}</span></li>
          <li class="list-group-item"><b>お支払いID</b>：<span style="float: right;"> {{ $order->payment_id }}</span></li>
          <li class="list-group-item"><b>取り引きID</b>：<span style="float: right;"> {{ $order->balance_transaction }}</span></li>
          <li class="list-group-item"><b>配達希望日</b>：<span style="float: right;">{{ $delivery_date }}</span></li>
          <li class="list-group-item"><b>配達希望時間</b>：<span style="float: right;">{{ $order->delivery_time }}</span></li>
          <li class="list-group-item"><b>商品合計（税込）</b>：<span style="float: right;"> {{ $order->sub_total_delimiter }}円</span></li>
          <li class="list-group-item"><b>送料</b>：<span style="float: right;"> {{ $order->shipping_fee }}円</span></li>
          @if ($order->coupon)
            <li class="list-group-item"><b>クーポン（{{ $order->coupon->coupon_name }}）</b>：<span style="float: right;">- {{ $order->discount_delimiter }}円</span></li>
          @endif
          <li class="list-group-item"><b>注文合計（税込）</b>：<span style="float: right;"> {{ $order->total_delimiter }}円</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection
