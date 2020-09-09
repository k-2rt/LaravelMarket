@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">商品</a>
      <span class="breadcrumb-item active">商品追加</span>
    </nav>

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">新規追加
        <a href="{{ route('index.product') }}" class="btn btn-success btn-sm pull-right">商品一覧</a>
        </h6>

        <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">商品名: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_name"  placeholder="商品名を入力してください">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">商品コード: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text"  name="product_code" placeholder="商品コードを入力してください">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">個数: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_quantity"  placeholder="個数を入力してください">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">販売価格: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="selling_price" placeholder="販売価格">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">カテゴリー: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="category_id">
                    <option value="">選択してください</option>
                    @foreach($categories as $category)

                      <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                    @endforeach

                  </select>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">サブカテゴリー: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="subcategory_id">
                    <option value="">選択してください</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">ブランド: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="brand_id">
                    <option value="">選択してください</option>
                    @foreach($brands as $brand)
                      <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>


              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">サイズ: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_size" id="size" data-role="tagsinput">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">カラー: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="product_color" id="color" data-role="tagsinput">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">割引価格:</label>
                  <input class="form-control" type="text" name="discount_price" placeholder="割引価格を入力してください">
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">商品詳細: <span class="tx-danger">*</span></label><br/>
                  <textarea class="form-control" id="summernote" name="product_details"></textarea>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">ビデオ URL:</label>
                  <input class="form-control" name="video_link" placeholder="URL">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">画像１(メイン): <span class="tx-danger">*</span></label><br />
                  <label class="custom-file">
                    <input type="file" class="custom-file-input" name="image_one" onchange="readURL(this);" required="">
                    <span class="custom-file-control"></span>
                  </label><br />
                  <img src="#" id="image_one" alt="">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">画像２:</label><br/>
                  <label class="custom-file">
                    <input type="file" class="custom-file-input" name="image_two" onchange="readURL(this);">
                    <span class="custom-file-control"></span>
                  </label><br />
                  <img src="#" id="image_two" alt="">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">画像３:</label><br/>
                  <label class="custom-file">
                    <input type="file" class="custom-file-input" name="image_three" onchange="readURL(this);">
                    <span class="custom-file-control"></span>
                  </label><br />
                  <img src="#" id="image_three" alt="">
                </div>
              </div>
            </div>
            <hr>
            <br>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="hot_new" value="1">
                  <span>新入荷</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="trend" value="1">
                  <span>トレンド</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="best_rated" value="1">
                  <span>最高評価</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="hot_deal" value="1">
                  <span>お買い得</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="main_slider" value="1">
                  <span>メイン スライダー</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="mid_slider" value="1">
                  <span>ミドル スライダー</span>
                </label>
              </div>
            </div>
            <br/>
            <br/>

            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5">追加する</button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </form>
      </div>
    </div>
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

  <!-- カテゴリー 選択肢 -->
  <script type="text/javascript">
    $(document).ready(function(){
      $('select[name="category_id"]').on('change',function(){
        var category_id = $(this).val();
        $('select[name="subcategory_id"]').empty();
        $('select[name="subcategory_id"]').append('<option value="">選択してください</option>');
        if (category_id) {
          $.ajax({
            url: "{{ url('/get/subcategory/') }}/" + category_id,
            type:"GET",
            dataType:"json",
            success:function(data) {
              $.each(data, function(key, value){
                $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
              });
            },
          });
        }
      });
    });
  </script>

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
