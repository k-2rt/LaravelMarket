@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">カテゴリー</a>
    <a class="breadcrumb-item" href="{{ route('subcategories') }}">サブ 一覧</a>
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
        <form action="{{ route('update.subcategory', ['id' => $subcategory->id]) }}" method="POST">
          @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="subcategory_name">サブカテゴリー名</label>
              <input type="text" class="form-control" id="subcateogry_name" value="{{ old('subcategory_name', $subcategory->subcategory_name) }}" name="subcategory_name">
            </div>

            <div class="form-group">
              <label for="category_id">カテゴリー</label>
              <select class="form-control" name="category_id">
                <option value="">--</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ $category->id == old('category_id', $subcategory->category_id) ? "selected" : "" }}>{{ $category->category_name }}</option>
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
