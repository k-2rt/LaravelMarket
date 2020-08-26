@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>サブカテゴリー テーブル</h5>
    </div>

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">
        サブカテゴリー 一覧
        <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">サブカテゴリーを追加</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">ID</th>
              <th class="wd-15p">サブカテゴリー名</th>
              <th class="wd-15p">カテゴリー名</th>
              <th class="wd-20p">アクション</a>
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($sub_categories as $key => $sub_category)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $sub_category->subcategory_name }}</td>
                <td>{{ $sub_category->category_name }}</td>
                <td>
                  <a href="{{ route('edit.subcategory', ['id' => $sub_category->id]) }}" class="btn btn-sm btn-info">編集</a>
                  <a href="{{ route('delete.subcategory', ['id' => $sub_category->id]) }}" class="btn btn-sm btn-danger" id="delete">削除</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">サブカテゴリー作成</h6>
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

        <form action="{{ route('store.subcategory') }}" method="POST">
          @csrf

          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="subcategory_name">サブカテゴリー名</label>
              <input type="text" class="form-control" id="subcategory_name" aria-describedby="emailHelp" placeholder="サブカテゴリー" name="subcategory_name">
            </div>

            <div class="form-group">
              <label for="category_id">カテゴリー名</label>
              <select class="form-control" name="category_id">
                <option value="">--</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->category_name }}</option>
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
