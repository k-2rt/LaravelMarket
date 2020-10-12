@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">カテゴリー</a>
    <span class="breadcrumb-item active">メイン 一覧</span>
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

      <h6 class="card-body-title">
        <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">新規作成</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">ID</th>
              <th class="wd-15p">カテゴリー名</th>
              <th class="wd-20p">アクション</th>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $key => $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category_name }}</td>
                <td>
                  <a href="{{ route('edit.category', ['id' => $category->id]) }}" class="btn btn-sm btn-info">編集</a>
                  <a href="{{ route('delete.category', ['id' => $category->id]) }}" class="btn btn-sm btn-danger" id="delete">削除</a>
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

        <form action="{{ route('store.category') }}" method="POST">
          @csrf

          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="category_name">カテゴリー名</label>
              <input type="text" class="form-control" id="category_name" aria-describedby="emailHelp" placeholder="カテゴリー" name="category_name">
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
