@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/shop_responsive.css') }}">

<!-- Shop -->

<div class="shop">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">

        <!-- Shop Sidebar -->
        <div class="shop_sidebar">
          <div class="sidebar_section">
            <div class="sidebar_title">カテゴリー</div>
            <ul class="sidebar_categories">

              @foreach ($categories as $category)
                <li><a href="{{ route('show.category.list', ['id' => $category->id]) }}">{{ $category->category_name }}</a></li>
              @endforeach

            </ul>
          </div>

          <div class="sidebar_section">
            <div class="sidebar_subtitle brands_subtitle">ブランド</div>
            <ul class="brands_list">
              @foreach ($brands as $brand)
                <li class="brand"><a href="#">{{ $brand->brand_name }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-9">
        <!-- Shop Content -->
        <div class="shop_content">
          <div class="shop_bar clearfix">
          <div class="shop_product_count">{{ $product_subcategory->category->category_name }} > {{ $product_subcategory->subcategory_name }} <span style="margin-left: 10px;">該当する商品</span> <span style="color: #0e8ce4;">{{ $products->count() }}</span> 件</div>
            <div class="shop_sorting">
              <span>並び替え：</span>
              <ul>
                <li>
                  <span class="sorting_text">高評価<i class="fas fa-chevron-down"></span></i>
                  <ul>
                    <li class="shop_sorting_button">高評価</li>
                    <li class="shop_sorting_button">低評価</li>
                    <li class="shop_sorting_button">入荷順</li>
                    <li class="shop_sorting_button">値段高</li>
                    <li class="shop_sorting_button">値段低</li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>

          <div class="product_grid row">
            <div class="product_grid_border"></div>

            @foreach ($products as $product)
              <!-- Product Item -->
              <div class="product_item is_new">
                <div class="product_border"></div>
                <div class="product_image d-flex flex-column align-items-center justify-content-center">
                  <a href="{{ route('product.detail', ['id' => $product->id, 'product_name' => $product->product_name]) }}" tabindex="0"><img src="{{ asset($product->image_one) }}" alt="" width="100px" height="100px"></a>
                </div>
                <div class="product_content">

                  @if($product->discount_price === NULL)
                    <div class="product_price">{{ number_format($product->selling_price) }}円</div>
                  @else
                    <div class="product_price">{{ number_format($product->discount_price) }}円<span>{{ number_format($product->selling_price) }}円</span></div>
                  @endif

                  <div class="product_name">
                    <div><a href="{{ route('product.detail', ['id' => $product->id, 'product_name' => $product->product_name]) }}" tabindex="0">{{ $product->product_name }}</a></div>
                  </div>
                </div>

                @auth
                  <div class="product_fav addWishList {{ $product->current_user_wish->count() ? 'active' : '' }}" data-id="{{ $product->id }}"><i class="fas fa-heart"></i></div>
                @endauth

                <ul class="product_marks">
                  @if($product->discount_price === NULL)
                    <li class="product_mark product_new">NEW</li>
                  @else
                    <li class="product_mark product_discount">
                      {{ $product->caluculateDiscountPercent() }}%
                    </li>
                  @endif
                </ul>
              </div>

            @endforeach
          </div>

          <!-- Shop Page Navigation -->
          <div class="shop_page_nav d-flex flex-row">
              {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
