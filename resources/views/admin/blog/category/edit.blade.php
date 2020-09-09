@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">ブログ</a>
    <a class="breadcrumb-item" href="{{ route('index.blog.category') }}">カテゴリー 一覧</a>
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

        <form action="{{ route('update.blog.category', ['id' => $blog_category->id]) }}" method="POST">
          @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="category_name_en">カテゴリー名(English)</label>
              <input type="text" class="form-control" id="category_name_en" aria-describedby="emailHelp" value="{{ $blog_category->category_name_en }}" name="category_name_en">
            </div>

            <div class="form-group">
              <label for="category_name_ja">カテゴリー名(Japanese)</label>
              <input type="text" class="form-control" id="category_name_ja" aria-describedby="emailHelp" value="{{ $blog_category->category_name_ja }}" name="category_name_ja">
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
