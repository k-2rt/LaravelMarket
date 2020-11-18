<!-- Banner -->

<div class="banner_2">
  <div class="banner_2_background" style="background:#f7f7f7"></div>
  <div class="banner_2_container">
    <div class="banner_2_dots"></div>
    <!-- Banner 2 Slider -->

    <div class="owl-carousel owl-theme banner_2_slider">

      <!-- Banner 2 Slider Item -->
      @foreach ($main_sliders as $slider)
        <div class="owl-item">
          <div class="banner_2_item">
            <div class="container fill_height">
              <div class="row fill_height">
                <div class="col-lg-4 col-md-6 fill_height">
                  <div class="banner_2_content">
                    <div class="banner_2_category"><h4>{{ $slider->category_name }}</h4></div>
                    <div class="banner_2_title">{{ $slider->product_name }}</div>
                    <div class="banner_2_text">
                      <h4>{{ $slider->brand_name }}</h4><br />
                      <h2>{{ number_format($slider->selling_price) }}円</h2>
                    </div>
                    <div class="button banner_2_button"><a href="{{ route('product.detail', ['id' => $slider->id, 'product_name' => $slider->product_name]) }}">詳細画面へ</a></div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-6 fill_height">
                  <div class="banner_2_image_container">
                    <div class="banner_2_image"><img src="{{ Storage::disk('s3')->url($slider->image_one) }}" alt=""></div>
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
