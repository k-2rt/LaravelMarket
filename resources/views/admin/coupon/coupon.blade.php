@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">

  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">
        クーポン 一覧
        <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">新規作成</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">ID</th>
              <th class="wd-15p">コード</th>
              <th class="wd-20p">割引率</th>
              <th class="wd-20p">アクション</th>
            </tr>
          </thead>
          <tbody>
            @foreach($coupons as $key => $coupon)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $coupon->coupon }}</td>
                <td>{{ $coupon->discount }} %</td>
                <td>
                  <a href="{{ route('edit.coupon', ['id' => $coupon->id]) }}" class="btn btn-sm btn-info">編集</a>
                  <a href="{{ route('delete.coupon', ['id' => $coupon->id]) }}" class="btn btn-sm btn-danger" id="delete">削除</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- modal form -->
  <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        <form action="{{ route('store.coupon') }}" method="POST">
          @csrf

          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="coupon">コード</label>
              <input type="text" class="form-control" id="coupon" aria-describedby="emailHelp" placeholder="クーポン" name="coupon">
            </div>

            <div class="form-group">
              <label for="discount">割引率（％）</label>
              <select class="form-control" name="discount">
                <option value="">--</option>
                @foreach($discount_percent as $percent)
                  <option value="{{ $percent }}">{{ $percent }}</option>
                @endforeach
              </select>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">追加する</button>
              <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">閉じる</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection