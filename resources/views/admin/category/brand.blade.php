@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">

  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>ブランド テーブル</h5>

    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">
        ブランド 一覧
        <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">ブランドを追加</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">ID</th>
              <th class="wd-15p">ブランド名</th>
              <th class="wd-15p">ブランドロゴ</th>
              <th class="wd-20p">アクション</a>
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($brands as $key => $brand)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $brand->brand_name }}</td>
                <td><img src="{{ URL::to($brand->brand_logo) }}" height="70px;" width="80px;"></td>
                <td>
                  <a href="{{ route('edit.brand', ['id' => $brand->id]) }}" class="btn btn-sm btn-info">編集</a>
                  <a href="{{ route('delete.brand', ['id' => $brand->id]) }}" class="btn btn-sm btn-danger" id="delete">削除</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- card -->
  </div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


  <!-- LARGE MODAL -->
  <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ブランド作成</h6>
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

        <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="brand_name">ブランド名</label>
              <input type="text" class="form-control" id="brand_name" aria-describedby="emailHelp" placeholder="ブランド" name="brand_name">
            </div>

            <div class="form-group">
              <label for="brand_name">ブランドロゴ</label>
              <input type="file" class="form-control" aria-describedby="emailHelp" placeholder="ブランドロゴ" name="brand_logo">
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">追加する</button>
              <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">閉じる</button>
            </div>
          </div>
        </form>

      </div><!-- modal-dialog -->
    </div><!-- modal -->
  </div>
</div>


@endsection
