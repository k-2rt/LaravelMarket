@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">その他</a>
    <span class="breadcrumb-item active">ニュース 一覧</span>
  </nav>

  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">
        <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">全削除</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">ID</th>
              <th class="wd-15p">メールアドレス</th>
              <th class="wd-15p">登録日時</th>
              <th class="wd-20p">アクション</th>
            </tr>
          </thead>
          <tbody>
            @foreach($newsletters as $newsletter)
              <tr>
                <td><input type="checkbox"> {{ $newsletter->id }}</td>
                <td>{{ $newsletter->email }}</td>
                <td>{{ \Carbon\Carbon::parse($newsletter->created_at)->diffForhumans() }}</td>
                <td>
                  <a href="{{ route('delete.newsletter', ['id' => $newsletter->id]) }}" class="btn btn-sm btn-danger" id="delete">削除</a>
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
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">カテゴリー作成</h6>
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
