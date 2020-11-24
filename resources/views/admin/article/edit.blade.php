@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">記事</a>
      <a class="breadcrumb-item" href="#">投稿 一覧</a>
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

        <h6 class="card-body-title">新規追加
        <a href="{{ route('index.article.category') }}" class="btn btn-success btn-sm pull-right">投稿一覧</a>
        </h6>
        <form action="{{ route('update.post', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-layout">
            <div class="row mg-b-25">

              <div class="col-lg-5 offset-lg-2">
                <div class="form-group">
                  <label class="form-control-label">タイトル: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text"  name="post_title_ja" value="{{ old('post_title_ja', $post->post_title_ja) }}" maxlength="50">
                </div>
              </div>

              <div class="col-lg-5">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">ブログ カテゴリー: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="post_category_id">
                    <option value="">選択してください</option>
                    @foreach($article_categories as $article_category)

                      <option value="{{ $article_category->id }}" {{ old('post_category_id', $post->post_category_id) == $article_category->id ? 'selected' : '' }}>{{ $article_category->category_name_ja }}</option>

                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">商品詳細: <span class="tx-danger">*</span></label><br/>
                  <textarea class="form-control article_text" id="" name="details_ja">{!! old('details_ja', $post->details_ja) !!}</textarea>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">投稿画像: <span class="tx-danger">*</span></label><br />
                  <label class="custom-file">
                    <input type="file" class="custom-file-input" name="post_image"" onchange="readURL(this);">
                    <span class="custom-file-control"></span>
                  </label>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">現在の画像: <span class="tx-danger">*</span></label><br />
                  <label class="custom-file">
                    @if ($post->storage_article_image)
                      <img src="{{ Storage::disk('s3')->url($post->post_image) }}" alt="" height="80px" width="130px">
                    @else
                      <img src="{{ asset('/panel/assets/images/noimage.png') }}" alt="" height="80px" width="130px">
                    @endif
                    <input type="hidden" name="old_image" value="{{ $post->post_image }}">
                  </label>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">新しい画像: <span class="tx-danger">*</span></label><br />
                  <label class="custom-file">
                    <img src="#" id="post_image" alt="">
                  </label>
                </div>
              </div>
            </div><br /><br />

            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">更新する</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- 画像 プレビュー表示 -->
  <script type="text/javascript">
    function readURL(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#' +  input.name)
            .attr('src', e.target.result)
            .width(130)
            .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

@endsection
