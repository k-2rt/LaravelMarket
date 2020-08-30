@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">カテゴリー 更新</h6>
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

        <form action="{{ route('update.category', ['id' => $category->id]) }}" method="POST">
          @csrf
          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="cateogry_name">カテゴリー名</label>
              <input type="text" class="form-control" id="cateogry_name" aria-describedby="emailHelp" value="{{ $category->category_name }}" name="category_name">
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
