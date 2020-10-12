@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">商品</a>
    <span class="breadcrumb-item active">商品在庫一覧</span>
  </nav>

  <div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">

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
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
              <tr>
                <td>{{ $product->product_code }}</td>
                <td>{{ $product->product_name }}</td>
                @if ($product->image_one)
                  <td><img src="{{ asset($product->image_one) }}" alt="" height="50px;" width="50px;"></td>
                @else
                  <td><img src="{{ asset('/panel/assets/images/noimage.png') }}" alt="" height="50px;" width="50px;"></td>
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
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
