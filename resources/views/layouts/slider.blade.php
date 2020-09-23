
<!-- Banner -->

<div class="banner">
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
</div>
