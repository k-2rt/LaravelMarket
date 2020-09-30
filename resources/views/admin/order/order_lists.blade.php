@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">注文</a>
      <span class="breadcrumb-item active">詳細一覧</span>
    </nav>
    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">お支払い方法</th>
                <th class="wd-15p">取引ID</th>
                <th class="wd-20p">商品合計</th>
                <th class="wd-20p">配送料</th>
                <th class="wd-20p">注文合計</th>
                <th class="wd-20p">注文日</th>
                <th class="wd-20p">ステータス</th>
                <th class="wd-20p">アクション</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->payment_type }}</td>
                  <td>{{ $order->balance_transaction }}</td>
                  <td>{{ number_format($order->subtotal) }}</td>
                  <td>{{ number_format($order->shipping_fee) }} </td>
                  <td>{{ number_format($order->total) }}</td>
                  <td>{{ $order->order_date }}</td>

                  <td>
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
                  </td>

                  <td>
                    <a href="{{ route('admin.order.details', ['id' => $order->id]) }}" class="btn btn-sm btn-info">詳細</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
