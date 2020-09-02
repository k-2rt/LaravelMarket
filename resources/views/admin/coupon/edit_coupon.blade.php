@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">クーポン</a>
    <a class="breadcrumb-item" href="{{ route('admin.coupon') }}">一覧</a>
    <span class="breadcrumb-item active">編集</span>
  </nav>

  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
      <div class="table-wrapper">
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        <form action="{{ route('update.coupon', ['id' => $coupon->id]) }}" method="POST">
          @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="coupon">コード</label>
              <input type="text" class="form-control" id="coupon" aria-describedby="emailHelp" value="{{ $coupon->coupon }}" name="coupon">
            </div>

            <div class="form-group">
              <label for="discount">割引率</label>
              <select class="form-control" name="discount">
                <option value="">--</option>
                @foreach($discount_percent as $percent)
                  <option value="{{ $percent }}" {{ $percent === $coupon->discount ? "selected" : "" }}>{{ $percent }}</option>
                @endforeach
              </select>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">更新する</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
