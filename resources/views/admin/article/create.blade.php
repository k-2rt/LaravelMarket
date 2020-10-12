@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">記事</a>
      <span class="breadcrumb-item active">投稿</span>
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
        <a href="{{ route('index.article.post') }}" class="btn btn-success btn-sm pull-right">投稿一覧</a>
        </h6>
        <form action="{{ route('store.article.post') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">タイトル(英語): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="post_title_en"  placeholder="タイトル(英語)を入力してください" value="{{ old('post_title_en')
                }}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">タイトル(日本語): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text"  name="post_title_ja" placeholder="タイトル(日本語)を入力してください" value="{{ old('post_title_ja')
                }}">
                </div>
              </div>


              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">記事 カテゴリー: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="post_category_id">
                    <option value="">選択してください</option>
                    @foreach($article_categories as $category)
                      <option value="{{ $category->id }}" {{ old('post_category_id') ==  $category->id ? 'selected' : ''}}>{{ $category->category_name_en }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">商品詳細(英語): <span class="tx-danger">*</span></label><br/>
                  <textarea class="form-control" id="summernote" name="details_en">{!! old('details_en')
                  !!}</textarea>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">商品詳細(日本語): <span class="tx-danger">*</span></label><br/>
                  <textarea class="form-control" id="summernote2" name="details_ja">{!! old('details_ja')
                  !!}</textarea>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">投稿画像: <span class="tx-danger">*</span></label><br />
                  <label class="custom-file">
                    <input type="file" class="custom-file-input" name="post_image"" onchange="readURL(this);" required="">
                    <span class="custom-file-control"></span>
                  </label><br /><br />
                  <img src="#" id="post_image" alt="">
                </div>
              </div>
            </div>
            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">投稿する</button>
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
            .width(80)
            .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

@endsection
