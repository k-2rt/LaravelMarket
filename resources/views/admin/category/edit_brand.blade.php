@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">カテゴリー</a>
    <a class="breadcrumb-item" href="{{ route('brands') }}">ブランド 一覧</a>
    <span class="breadcrumb-item active">編集</span>
  </nav>

  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
      @if ($errors->any())
        <div class="alert">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="table-wrapper">

        <form action="{{ route('update.brand', ['id' => $brand->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="brand_name">ブランド名</label>
              <input type="text" class="form-control" id="brand_name" value="{{ old('brand_name', $brand->brand_name) }}" name="brand_name">
            </div>

            <div class="form-group">
              <label for="brand_logo">ブランドロゴ</label>
              <input type="file" class="form-control" id="brand_logo" name="brand_logo">
            </div>

            <div class="form-group">
              <label>現在のブランドロゴ</label>
              @if ($brand->brand_logo)
                <img src="{{ asset($brand->brand_logo) }}" alt="" height="70px" width="80px">
              @else
                <img src="{{ asset('/panel/assets/images/noimage.png') }}" alt="" height="70px" width="80px">
              @endif

              <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
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
