@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">ブログ</a>
      <a class="breadcrumb-item" href="#">投稿 一覧</a>
      <span class="breadcrumb-item active">編集</span>
    </nav>

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">新規追加
        <a href="{{ route('index.blog.category') }}" class="btn btn-success btn-sm pull-right">投稿一覧</a>
        </h6>
        <form action="{{ route('update.post', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">タイトル(英語): <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="post_title_en"  value="{{ $post->post_title_en }}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">タイトル(日本語): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text"  name="post_title_ja" value="{{ $post->post_title_ja }}"">
                </div>
              </div>


              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">ブログ カテゴリー: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="category_id">
                    <option value="">選択してください</option>
                    @foreach($blog_categories as $blog_category)

                      <option value="{{ $blog_category->id }}" {{ $post->category_id == $blog_category->id ? 'selected' : '' }}>{{ $blog_category->category_name_en }}</option>

                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">商品詳細(英語): <span class="tx-danger">*</span></label><br/>
                <textarea class="form-control" id="summernote" name="details_en">{!! $post->details_en !!}</textarea>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">商品詳細(日本語): <span class="tx-danger">*</span></label><br/>
                  <textarea class="form-control" id="summernote2" name="details_ja">{!! $post->details_ja !!}</textarea>
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
                    <img src="{{ URL::to($post->post_image) }}" alt="" height="80px" width="130px">
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
