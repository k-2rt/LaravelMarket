@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>編集画面</h5>
    </div>

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">サブカテゴリー 更新</h6>
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

        <form action="{{ route('update.subcategory', ['id' => $subcategory->id]) }}" method="POST">
          @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="subcategory_name">サブカテゴリー名</label>
              <input type="text" class="form-control" id="subcateogry_name" aria-describedby="emailHelp" value="{{ $subcategory->subcategory_name }}" name="subcategory_name">
            </div>

            <div class="form-group">
              <label for="category_id">カテゴリー名</label>
              <select class="form-control" name="category_id">
                <option value="">--</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ $category->id === $subcategory->category_id ? "selected" : "" }}>{{ $category->category_name }}</option>
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
