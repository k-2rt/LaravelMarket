@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">商品</a>
    <span class="breadcrumb-item active">商品一覧</span>
  </nav>

  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">
      <a href="{{ route('create.product') }}" class="btn btn-sm btn-warning" style="float: right;">新規作成</a>
      </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p">商品コード</th>
              <th class="wd-15p">商品名</th>
              <th class="wd-15p">画像</th>
              <th class="wd-15p">カテゴリー</th>
              <th class="wd-15p">ブランド</th>
              <th class="wd-15p">個数</th>
              <th class="wd-15p">ステータス</th>
              <th class="wd-20p">アクション</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
              <tr>
                <td>{{ $product->product_code }}</td>
                <td>{{ $product->product_name }}</td>

                @if ($product->storage_product_image_one)
                  <td><img src="{{ Storage::disk('s3')->url($product->image_one) }}" height="50px;" width="50px;"></td>
                @else
                  <td><img src="{{ asset('/panel/assets/images/noimage.png') }}" height="50px;" width="50px;"></td>
                @endif

                <td>{{ $product->category->category_name }}</td>
                <td>{{ $product->brand->brand_name }}</td>
                <td>{{ $product->product_quantity }}</td>
                <td>
                  @if ( $product->status == 1 )
                    <span class="badge badge-success">有効</span>
                  @else
                    <span class="badge badge-danger">無効</span>
                  @endif
                </td>

                <td>
                  <a href="{{ route('edit.product', ['id' => $product->id]) }}" class="btn btn-sm btn-info" title="編集"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('delete.product', ['id' => $product->id]) }}" class="btn btn-sm btn-danger" id="delete" title="削除"><i class="fa fa-trash"></i></a>
                  <a href="{{ route('show.product', ['id' => $product->id]) }}" class="btn btn-sm btn-warning" title="詳細"><i class="fa fa-eye"></i></a>
                  @if ($product->status == 1)
                    <a href="{{ route('inactive.product', ['id' => $product->id]) }}" class="btn btn-sm btn-danger" title="無効化"><i class="fa fa-thumbs-down"></i></a>
                  @else
                    <a href="{{ route('active.product', ['id' => $product->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-thumbs-up" title="有効化"></i></a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
