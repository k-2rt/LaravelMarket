@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">報告</a>
      <span class="breadcrumb-item active">注文一覧（本日）</span>
    </nav>
    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-25p">取引ID</th>
                <th class="wd-15p">お支払い方法</th>
                <th class="wd-15p">商品合計</th>
                <th class="wd-15p">配送料</th>
                <th class="wd-15p">注文合計</th>
                <th class="wd-15p">注文日</th>
                <th class="">ステータス</th>
                <th class=""></th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->balance_transaction }}</td>
                  <td>{{ $order->payment_type }}</td>
                  <td>{{ $order->sub_total_delimiter }}円</td>
                  <td>{{ $order->shipping_fee }}円</td>
                  <td>{{ $order->total_delimiter }}円</td>
                  <td>{{ $order->order_date }}</td>

                  <td>
                    @if ($order->status === '0')
                      <span class="badge badge-warning">承認待ち</span>
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
