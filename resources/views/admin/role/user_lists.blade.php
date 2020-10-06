@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">ユーザー管理</a>
    <span class="breadcrumb-item active">ユーザー 一覧</span>
  </nav>

  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">
        <a href="{{ route('admin.create.user') }}" class="btn btn-sm btn-warning" style="float: right;">新規作成</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-25p">名前</th>
              <th class="wd-25p">電話番号</th>
              <th class="wd-30p">アクセス権限</th>
              <th class="wd-20p">アクション</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                  @if ($user->category === '1')
                    <span class="badge badge-info">カテゴリー</span>
                  @endif

                  @if ($user->coupon === '1')
                    <span class="badge badge-warning">クーポン</span>
                  @endif

                  @if ($user->product === '1')
                    <span class="badge badge-primary">商品</span>
                  @endif

                  @if ($user->article === '1')
                    <span class="badge badge-success">記事</span>
                  @endif

                  @if ($user->other === '1')
                    <span class="badge badge-secondary">その他</span>
                  @endif

                  @if ($user->order === '1')
                    <span class="badge badge-info">注文</span>
                  @endif

                  @if ($user->report === '1')
                    <span class="badge badge-warning">リポート</span>
                  @endif

                  @if ($user->role === '1')
                    <span class="badge badge-primary">ユーザー管理</span>
                  @endif

                  @if ($user->return === '1')
                    <span class="badge badge-success">Return</span>
                  @endif

                  @if ($user->contact === '1')
                    <span class="badge badge-secondary">Contact</span>
                  @endif

                  @if ($user->comment === '1')
                    <span class="badge badge-info">コメント</span>
                  @endif

                  @if ($user->setting === '1')
                    <span class="badge badge-warning">設定</span>
                  @endif
                </td>

                <td>
                  <a href="{{ route('edit.admin', ['id' => $user->id]) }}" class="btn btn-sm btn-info">編集</a>
                  <a href="{{ route('delete.admin', ['id' => $user->id]) }}" class="btn btn-sm btn-danger" id="delete">削除</a>
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
      </div>
    </div>
  </div>
</div>


@endsection
