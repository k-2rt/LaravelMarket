@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">商品</a>
      <a class="breadcrumb-item" href="{{ route('index.product') }}">商品一覧</a>
      <span class="breadcrumb-item active">商品詳細</span>
    </nav>

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">商品詳細
          <a href="{{ route('index.product') }}" class="btn btn-success btn-sm pull-right">商品一覧</a>
        </h6><br />

        <div class="form-layout">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">商品名: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_name }}</strong>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">商品コード: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_code }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">個数: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_quantity }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">カテゴリー: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->category_name }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">サブカテゴリー: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->subcategory_name }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">ブランド: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->brand_name }}</strong>
              </div>
            </div>


            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">サイズ: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_size }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">カラー: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_color }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">販売価格: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->selling_price }}</strong>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">商品詳細: <span class="tx-danger">*</span></label><br/>
                <p>{!! $product->product_details !!}</p>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">ビデオ URL:</label><br>
                <strong>{{ $product->video_link }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">画像１(メイン): <span class="tx-danger">*</span></label><br />
                @if ($product->storage_product_image_one)
                  <img src="{{ asset($product->image_one) }}" alt="" height="80px" width="80px">
                @else
                  <img src="{{ asset('/panel/assets/images/noimage.png') }}" alt="" height="80px" width="80px">
                @endif
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">画像２:</label><br/>
                @if ($product->storage_product_image_two)
                  <img src="{{ asset($product->image_one) }}" alt="" height="80px" width="80px">
                @else
                  <img src="{{ asset('/panel/assets/images/noimage.png') }}" alt="" height="80px" width="80px">
                @endif
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">画像３:</label><br/>
                @if ($product->storage_product_image_three)
                  <img src="{{ asset($product->image_three) }}" alt="" height="80px" width="80px">
                @else
                  <img src="{{ asset('/panel/assets/images/noimage.png') }}" alt="" height="80px" width="80px">
                @endif
              </div>
            </div>
          </div>
          <hr>
          <br>
          <br>
          <div class="row">
            <div class="col-lg-4">
              @if ($product->hot_new == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>新入荷</span>
            </div>

            <div class="col-lg-4">
              @if ($product->trend == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>トレンド</span>
            </div>

            <div class="col-lg-4">
              @if ($product->best_rated == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>最高評価</span>
            </div>

            <div class="col-lg-4">
              @if ($product->hot_deal == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>お買い得</span>
            </div>

            <div class="col-lg-4">
              @if ($product->main_slider == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>メイン スライダー</span>
            </div>

            <div class="col-lg-4">
              @if ($product->mid_slider == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>ミドル スライダー</span>
            </div>
          </div>
        </div><!-- form-layout -->
      </div><!-- card -->
    </div>
  </div><!-- sl-mainpanel -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

@endsection
