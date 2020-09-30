@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">注文</a>
      <a class="breadcrumb-item" href="{{ route('admin.pending.order') }}">承認待ち一覧</a>
      <span class="breadcrumb-item active">注文詳細</span>
    </nav>
    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h6 class="card-body-title">注文詳細</h6>
                <table class="table">
                  <tr>
                    <th>注文者:</th>
                  <th>{{ $order->user->name }}</th>
                  </tr>
                  <tr>
                    <th>電話番号:</th>
                    <th>{{ $order->user->phone }}</th>
                  </tr>
                  <tr>
                    <th>お支払い方法:</th>
                    <th>{{ $order->payment_type }}</th>
                  </tr>
                  <tr>
                    <th>お支払いID:</th>
                    <th>{{ $order->payment_id }}</th>
                  </tr>
                  <tr>
                    <th>注文合計:</th>
                    <th>{{ $order->total_delimiter }}</th>
                  </tr>
                  <tr>
                    <th>注文日:</th>
                    <th>{{ $order->order_date }}</th>
                  </tr>
                  <tr>
                    <th>注文状況:</th>
                    <th>
                      @if ($order->status === '0')
                        <span class="badge badge-warning">保留中</span>
                      @elseif ($order->status === '1')
                        <span class="badge badge-info">支払い完了</span>
                      @elseif ($order->status === '2')
                        <span class="badge badge-warning">配達中</span>
                      @elseif ($order->status === '3')
                        <span class="badge badge-success">配達済み</span>
                      @else
                        <span class="badge badge-danger">キャンセル</span>
                      @endif
                    </th>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h6 class="card-body-title">配送先詳細</h6>
                <table class="table">
                  <tr>
                    <th>氏名:</th>
                  <th>{{ $shipping->ship_name }}</th>
                  </tr>
                  <tr>
                    <th>電話番号:</th>
                    <th>{{ $shipping->ship_phone }}</th>
                  </tr>
                  <tr>
                    <th>メールアドレス:</th>
                    <th>{{ $shipping->ship_email }}</th>
                  </tr>
                  <tr>
                    <th>郵便番号:</th>
                    <th>{{ $shipping->configure_zip }}</th>
                  </tr>
                  <tr>
                    <th>都道府県:</th>
                    <th>{{ $shipping->pref_name }}</th>
                  </tr>
                  <tr>
                    <th>住所１:</th>
                    <th>{{ $shipping->ship_address1 }}</th>
                  </tr>
                  <tr>
                    <th>住所２:</th>
                    <th>{{ $shipping->ship_address2 }}</th>
                  </tr>

                </table>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="card pd-20 pd-sm-40 col-lg-12">
            <h6 class="card-body-title">
             商品詳細
            </h6>

            <div class="table-wrapper">
              <table class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-10p">商品ID</th>
                    <th class="wd-20p">商品名</th>
                    <th class="wd-10p">画像</th>
                    <th class="wd-15p">カラー</th>
                    <th class="wd-15p">サイズ</th>
                    <th class="wd-10p">個数</th>
                    <th class="wd-10p">商品価格</th>
                    <th class="wd-10p">注文合計</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($order_details as $detail)
                    <tr>
                      <td>{{ $detail->product->product_code }}</td>
                      <td>{{ $detail->product_name }}</td>
                      <td><img src="{{ URL::to($detail->product->image_one) }}" height="50px;" width="50px;"></td>
                      <td>{{ $detail->color }}</td>
                      <td>{{ $detail->size }}</td>
                      <td>{{ $detail->quantity }}</td>
                      <td>{{ $detail->unit_delimiter }}</td>
                      <td>{{ $detail->total_delimiter }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        @if ($order->status === '0')
          <a href="{{ route('admin.accept.payment', ['id' => $order->id]) }}" class="btn btn-info">支払いを承認</a>
          <br />
          <a href="{{ route('admin.cancel.payment', ['id' => $order->id]) }}" class="btn btn-danger">支払いをキャンセル</a>
        @elseif ($order->status === '1')
          <a href="{{ route('admin.update.process.order', ['id' => $order->id]) }}" class="btn btn-info">配達中に更新</a>
        @elseif ($order->status === '2')
          <a href="{{ route('admin.delivery.done', ['id' => $order->id]) }}" class="btn btn-info">配達済み</a>
        @elseif ($order->status === '3')
          <strong class="text-success text-center">この商品は、目的地に配送されました</strong>
        @elseif ($order->status === '4')
          <strong class="text-danger text-center">この注文は、キャンセルされました</strong>
        @endif

      </div>
    </div>
  </div>

@endsection
