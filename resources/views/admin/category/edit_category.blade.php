@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">カテゴリー</a>
    <a class="breadcrumb-item" href="{{ route('categories') }}">メイン 一覧</a>
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
        <form action="{{ route('update.category', ['id' => $category->id]) }}" method="POST">
          @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="category_name">カテゴリー名</label>
              <input type="text" class="form-control" id="category_name" value="{{ old('category_name', $category->category_name) }}" name="category_name">
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
