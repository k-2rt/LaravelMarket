<!-- Banner -->

<div class="banner_2">
  <div class="banner_2_background" style="background:#f7f7f7"></div>
  <div class="banner_2_container">
    <div class="banner_2_dots"></div>
    <!-- Banner 2 Slider -->

    <div class="owl-carousel owl-theme banner_2_slider">

      <!-- Banner 2 Slider Item -->
      @foreach ($mid_slider_products as $mid_slider)
        <div class="owl-item">
          <div class="banner_2_item">
            <div class="container fill_height">
              <div class="row fill_height">
                <div class="col-lg-4 col-md-6 fill_height">
                  <div class="banner_2_content">
                    <div class="banner_2_category"><h4>{{ $mid_slider->category_name }}</h4></div>
                    <div class="banner_2_title">{{ $mid_slider->product_name }}</div>
                    <div class="banner_2_text">
                      <h4>{{ $mid_slider->brand_name }}</h4><br />
                      <h2>{{ number_format($mid_slider->selling_price) }}円</h2>
                    </div>
                    <div class="button banner_2_button"><a href="{{ route('product.detail', ['id' => $mid_slider->id, 'product_name' => $mid_slider->product_name]) }}">詳細画面へ</a></div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 fill_height">
                  <div class="banner_2_image_container">
                    <div class="banner_2_image"><img src="{{ asset($mid_slider->image_one) }}" alt="" height="400px" width="250px"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</div>

<!-- Banner -->

{{-- <div class="banner">
  <div class="banner_background" style="background-image:url(frontend/images/banner_background.jpg)"></div>
  <div class="container fill_height">
    <div class="row fill_height">
      <div class="banner_product_image"><img src="{{ asset($main_slider->image_one) }}" alt="" height="400px"></div>
      <div class="col-lg-5 offset-lg-4 fill_height">
        <div class="banner_content">
        <h1 class="banner_text">{{ $main_slider->product_name }}</h1>
        <div class="banner_price">
          @if($main_slider->discount_price === NULL)
            <h2>{{ number_format($main_slider->selling_price) }}円</h2>
          @else
            <span>{{ number_format($main_slider->selling_price) }}円</span>{{ number_format($main_slider->discount_price) }}円
          @endif

        </div>
        <div class="banner_product_name">{{ $main_slider->brand_name }}</div>
          <div class="button banner_button"><a href="#">Shop Now</a></div>
        </div>
      </div>
    </div>
  </div>
</div> --}}
