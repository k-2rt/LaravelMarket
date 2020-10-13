@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">記事</a>
    <span class="breadcrumb-item active">投稿 一覧</span>
  </nav>

  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">
      <a href="{{ route('create.article.post') }}" class="btn btn-sm btn-warning" style="float: right;">新規作成</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">タイトル</th>
              <th class="wd-15p">カテゴリー</th>
              <th class="wd-15p">画像</th>
              <th class="wd-15p">作成スタッフ</th>
              <th class="wd-15p">更新スタッフ</th>
              <th class="wd-10p"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $post)
              <tr>
                <td>{{ $post->post_title_ja }}</td>
                <td>{{ $post->category_name_ja }}</td>
                @if ($post->storage_article_image)
                  <td><img src="{{ asset($post->post_image) }}" alt="" height="50px;" width="50px;"></td>
                @else
                  <td><img src="{{ asset('/panel/assets/images/noimage.png') }}" alt="" height="50px;" width="50px;"></td>
                @endif
                <td>{{ $post->create_user }}</td>
                <td>{{ $post->update_user }}</td>
                <td>
                  <a href="{{ route('edit.post', ['id' => $post->id]) }}" class="btn btn-sm btn-info">編集</a>
                  <a href="{{ route('delete.post', ['id' => $post->id]) }}" class="btn btn-sm btn-danger" id="delete">削除</a>
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

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        <form action="{{ route('store.article.category') }}" method="POST">
          @csrf

          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="category_name">カテゴリー名(English)</label>
              <input type="text" class="form-control" id="category_name" aria-describedby="emailHelp" placeholder="English Name" name="category_name_en">
            </div>
            <div class="form-group">
              <label for="category_name">カテゴリー名(Japanese)</label>
              <input type="text" class="form-control" id="category_name" aria-describedby="emailHelp" placeholder="日本語名" name="category_name_ja">
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
