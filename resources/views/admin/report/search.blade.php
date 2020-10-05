@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">報告</a>
      <span class="breadcrumb-item active">注文検索</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row">
        <div class="col-lg-4">
          <div class="card pd-20">
            <div class="table-wrapper">
              <form action="{{ route('search.report') }}" method="GET">
                @csrf

                <div class="pd-20">
                  <div class="form-group">
                    <div><label for="order_date_from">注文日</label></div>
                  <input type="date" class="form-date" id="order_date_from" name="order_date_from" value="{{ $keywords['order_date_from'] }}"> 〜
                    <input type="date" class="form-date" id="order_date_to" name="order_date_to" value="{{ $keywords['order_date_to'] }}">
                  </div>
                </div>


                <div class="pd-20">
                  <div class="form-group">
                    <div><label for="transaction">取引ID</label></div>
                    <input type="text" class="form-date" name="transaction" value="{{ $keywords['transaction'] }}">
                  </div>
                </div>

                <div class="pd-20">
                  <div class="form-group">
                    <div><label>支払い方法</label></div>
                    <label class="payment-ckbox">
                      <input type="checkbox" class="check-payment" value="stripe" name="payment[]" {{ (!empty($keywords['payment']) && in_array('stripe', $keywords['payment'])) ? 'checked' : ''}}>
                      <span>Stripe</span>
                    </label>
                    <label class="payment-ckbox">
                      <input type="checkbox" class="check-payment" value="paypal" name="payment[]" {{ (!empty($keywords['payment']) && in_array('paypal', $keywords['payment'])) ? 'checked' : ''}}>
                      <span>Paypal</span>
                    </label>
                    <label class="payment-ckbox">
                      <input type="checkbox" class="check-payment" value="ideal" name="payment[]" {{ (!empty($keywords['payment']) && in_array('ideal', $keywords['payment'])) ? 'checked' : ''}}>
                      <span>iDeal</span>
                    </label>
                  </div>
                </div>

                <div class="pd-20">
                  <div class="form-group">
                    <div><label>注文ステータス</label></div>
                    <label class="search-ckbox">
                      <input type="checkbox" value="0" name="status[]" {{ (!empty($keywords['status']) && in_array('0', $keywords['status'])) ? 'checked' : ''}}>
                      <span>承認待ち</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="1" name="status[]" {{ (!empty($keywords['status']) && in_array('1', $keywords['status'])) ? 'checked' : ''}}>
                      <span>支払い完了</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="2" name="status[]" {{ (!empty($keywords['status']) && in_array('2', $keywords['status'])) ? 'checked' : ''}}>
                      <span>配達中</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="3" name="status[]" {{ (!empty($keywords['status']) && in_array('3', $keywords['status'])) ? 'checked' : ''}}>
                      <span>配達済み</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="4" name="status[]" {{ (!empty($keywords['status']) && in_array('4', $keywords['status'])) ? 'checked' : ''}}>
                      <span>キャンセル</span>
                    </label>
                  </div>
                </div>

                <div class="pd-20">
                  <div class="form-group">
                    <div><label>商品合計</label></div>
                    <label class="search-ckbox">
                      <input type="checkbox" value="max2000" name="subtotal[]" {{ (!empty($keywords['subtotal']) && in_array('max2000', $keywords['subtotal'])) ? 'checked' : ''}}>
                      <span>1 〜 2000 円</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="max5000" name="subtotal[]" {{ (!empty($keywords['subtotal']) && in_array('max5000', $keywords['subtotal'])) ? 'checked' : ''}}>
                      <span>2000 〜 5000 円</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="max10000" name="subtotal[]" {{ (!empty($keywords['subtotal']) && in_array('max10000', $keywords['subtotal'])) ? 'checked' : ''}}>
                      <span>5000 〜 10000 円</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="over10000" name="subtotal[]" {{ (!empty($keywords['subtotal']) && in_array('over10000', $keywords['subtotal'])) ? 'checked' : ''}}>
                      <span>10000 円以上</span>
                    </label>
                  </div>
                </div>

                <div class="pd-20">
                  <div class="form-group">
                    <div><label>注文合計</label></div>
                    <label class="search-ckbox">
                      <input type="checkbox" value="max2000" name="total[]" {{ (!empty($keywords['total']) && in_array('max2000', $keywords['total'])) ? 'checked' : ''}}>
                      <span>1 〜 2000 円</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="max5000" name="total[]" {{ (!empty($keywords['total']) && in_array('max5000', $keywords['total'])) ? 'checked' : ''}}>
                      <span>2000 〜 5000 円</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="max10000" name="total[]" {{ (!empty($keywords['total']) && in_array('max10000', $keywords['total'])) ? 'checked' : ''}}>
                      <span>5000 〜 10000 円</span>
                    </label>
                    <label class="search-ckbox">
                      <input type="checkbox" value="over10000" name="total[]" {{ (!empty($keywords['total']) && in_array('over10000', $keywords['total'])) ? 'checked' : ''}}>
                      <span>10000 円以上</span>
                    </label>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-warning pd-x-20" onClick="clearConditions(this.form)">条件クリア</button>
                  <button type="submit" class="btn btn-info pd-x-20">検索する</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card pd-20 pd-sm-40">
            <div class="table-wrapper">
              <table id="datatable2" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-20p">注文日</th>
                    <th class="wd-25p">取引ID</th>
                    <th class="wd-15p">お支払い方法</th>
                    <th class="wd-20p">商品合計</th>
                    <th class="wd-20p">注文合計</th>
                    <th class="">ステータス</th>
                    <th class=""></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td>{{ $order->order_date }}</td>
                      <td>{{ $order->balance_transaction }}</td>
                      <td>{{ $order->payment_type }}</td>
                      <td>{{ $order->sub_total_delimiter }}円</td>
                      <td>{{ $order->total_delimiter }}円</td>

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
    </div>
  </div>

  {{-- 入力情報の削除 --}}
  <script type="text/javascript">
    function clearConditions(form){
      $(form)
          .find("input, select, textarea")
          .not(":button, :submit, :hidden")
          .val("")
          .prop("checked", false)
          .prop("selected", false)
      ;
    }
  </script>

@endsection
