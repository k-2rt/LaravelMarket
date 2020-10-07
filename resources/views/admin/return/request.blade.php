@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">返品管理</a>
      <span class="breadcrumb-item active">{{ $page_title }}</span>
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
                <th class="">返品状況</th>
                <th class=""></th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->balance_transaction }}</td>
                  <td>{{ $order->payment_type }}</td>
                  <td>{{ number_format($order->subtotal) }}円</td>
                  <td>{{ number_format($order->shipping_fee) }}円</td>
                  <td>{{ number_format($order->total) }}円</td>
                  <td>{{ $order->order_date }}</td>

                  <td>
                    @if ($order->return_status === '1')
                      <span class="badge badge-warning">承認待ち</span>
                    @elseif ($order->return_status === '2')
                      <span class="badge badge-success">返品完了</span>
                    @endif
                  </td>

                  <td>
                    @if ($order->return_status === '1')
                      <a href="{{ route('admin.approve.request', ['id' => $order->id]) }}" class="btn btn-sm btn-info" id="approve">承認</a>
                    @elseif ($order->return_status === '2')
                      <a href="#" class="btn btn-sm btn-success">返品済み</a>
                    @endif

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
