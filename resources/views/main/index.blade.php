@extends('layouts.app')

@section('content')

@include('layouts.menubar')
@include('layouts.slider')

  <div class="characteristics">
		<div class="container">
			<div class="row">

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{ asset('/frontend/images/char_1.png') }}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{ asset('/frontend/images/char_2.png') }}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{ asset('/frontend/images/char_3.png') }}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">

					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="{{ asset('/frontend/images/char_4.png') }}" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Deals of the week -->

	<div class="deals_featured">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

					<!-- Deals -->

					<div class="deals">
						<div class="deals_title">Deals of the Week</div>
						<div class="deals_slider_container">

							<!-- Deals Slider -->
							<div class="owl-carousel owl-theme deals_slider">

								<!-- Deals Item -->
								@foreach($hot_deal_products as $hot_deal)
									<div class="owl-item deals_item">
										<div class="deals_image"><img src="{{ asset( $hot_deal->image_one ) }}" alt=""></div>
										<div class="deals_content">
											<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_category"><a href="#">{{ $hot_deal->brand_name }}</a></div>

												@if($hot_deal->discount_price !== NULL)
													<div class="deals_item_price_a ml-auto">{{ number_format($hot_deal->selling_price) }}円</div>
												@endif

											</div>
											<div class="deals_info_line d-flex flex-row justify-content-start">
											<div class="deals_item_name">{{ $hot_deal->product_name }}</div>

											@if($hot_deal->discount_price === NULL)
												<div class="deals_item_price ml-auto">{{ number_format($hot_deal->selling_price) }}円</div>
											@else
												<div class="deals_item_price ml-auto">{{ number_format($hot_deal->discount_price) }}円</div>
											@endif

											</div>
											<div class="available">
												<div class="available_line d-flex flex-row justify-content-start">
												<div class="available_title">数量: <span>{{ $hot_deal->product_quantity }}</span></div>
													<div class="sold_title ml-auto">Already sold: <span>28</span></div>
												</div>
												<div class="available_bar"><span style="width:17%"></span></div>
											</div>
											<div class="deals_timer d-flex flex-row align-items-center justify-content-start">
												<div class="deals_timer_title_container">
													<div class="deals_timer_title">Hurry Up</div>
													<div class="deals_timer_subtitle">Offer ends in:</div>
												</div>
												<div class="deals_timer_content ml-auto">
													<div class="deals_timer_box clearfix" data-target-time="">
														<div class="deals_timer_unit">
															<div id="deals_timer1_hr" class="deals_timer_hr"></div>
															<span>hours</span>
														</div>
														<div class="deals_timer_unit">
															<div id="deals_timer1_min" class="deals_timer_min"></div>
															<span>mins</span>
														</div>
														<div class="deals_timer_unit">
															<div id="deals_timer1_sec" class="deals_timer_sec"></div>
															<span>secs</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach

							</div>
						</div>

						<div class="deals_slider_nav_container">
							<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
							<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
						</div>
					</div>

					<!-- Featured -->
					<div class="featured">
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">おすすめ</li>
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>

							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">

									<!-- Slider Item -->
									@foreach($active_products as $product)
										<div class="featured_slider_item">
											<div class="border_active"></div>
											<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($product->image_one) }}" alt="" height="120px" width="100px"></div>
												<div class="product_content">
													@if($product->discount_price === NULL)
														<div class="product_price">{{ number_format($product->selling_price) }}円</div>
													@else
														<div class="product_price">{{ number_format($product->discount_price) }}円<span>{{ number_format($product->selling_price) }}円</span></div>
													@endif
													<div class="product_name"><div><a href="{{ route('product.detail', ['id' => $product->id, 'product_name' => $product->product_name]) }}">{{ $product->product_name }}</a></div></div>

													<div class="product_extras">
														<a href="{{ route('product.detail', ['id' => $product->id, 'product_name' => $product->product_name]) }}">
															<button class="product_cart_button">購入画面へ</button>
														</a>
													</div>
												</div>

												@auth
														<div class="product_fav addWishList" data-id="{{ $product->id }}"><i class="fas fa-heart"></i></div>
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
										</div>
									@endforeach

								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Trends -->

	<div class="trends">
		<div class="trends_background"></div>
		<div class="trends_overlay"></div>
		<div class="container">
			<div class="row">

				<!-- Trends Content -->
				<div class="col-lg-3">
					<div class="trends_container">
						<h2 class="trends_title">Buy One Get One</h2>
						<div class="trends_text"><p></p></div>
						<div class="trends_slider_nav">
							<div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
					</div>
				</div>

				<!-- Trends Slider -->
				<div class="col-lg-9">
					<div class="trends_slider_container">

						<!-- Trends Slider -->

						<div class="owl-carousel owl-theme trends_slider">

							<!-- Trends Slider Item -->
							@foreach ($buyone_getone_products as $product)
								<div class="owl-item">
									<div class="trends_item is_new product_item">
										<div class="trends_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset( $product->image_one ) }}" alt="" height="200px"></div>
										<div class="trends_content">
										<div class="trends_category"><a href="#">{{ $product->brand_name }}</a></div>
											<div class="trends_info clearfix">
												<div class="trends_name"><a href="product.html">{{ $product->product_name }}</a></div>

												@if($product->discount_price === NULL)
													<div class="product_price discount">{{ number_format($product->selling_price) }}円</div>
												@else
													<div class="product_price discount">{{ number_format($product->discount_price) }}円<span>{{ number_format($product->selling_price) }}円</span></div>
												@endif

												<a href="" class="btn btn-primary btn-sm font-weight-bold" style="margin-top: 5px;">カートに入れる</a>

											</div>
										</div>
										<ul class="trends_marks">
											<li class="trends_mark trends_discount">SALE</li>
										</ul>
										@auth
											<div class="trends_fav addWishList" data-id="{{ $product->id }}"><i class="fas fa-heart"></i></div>
										@endauth
									</div>
								</div>

							@endforeach

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Hot New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
						<div class="new_arrivals_title">{{ $first_category->category_name }}</div>
							<ul class="clearfix">
								<li class="active"></li>

							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										@foreach($new_arraival_products as $product)
											<div class="featured_slider_item">
												<div class="border_active"></div>
												<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
													<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($product->image_one) }}" alt="" height="120px" width="100px"></div>
													<div class="product_content">
														@if($product->discount_price === NULL)
															<div class="product_price discount">{{ number_format($product->selling_price) }}円</div>
														@else
															<div class="product_price discount">{{ number_format($product->discount_price) }}円<span>{{ number_format($product->selling_price) }}円</span></div>
														@endif
														<div class="product_name"><div><a href="product.html">{{ $product->product_name }}</a></div></div>
														<div class="product_extras">
															<div class="product_color">
																<input type="radio" checked name="product_color" style="background:#b19c83">
																<input type="radio" name="product_color" style="background:#000000">
																<input type="radio" name="product_color" style="background:#999999">
															</div>
															<a href="{{ route('product.detail', ['id' => $product->id, 'product_name' => $product->product_name]) }}">
																<button class="product_cart_button">購入画面へ</button>
															</a>
														</div>
													</div>

													@auth
														<div class="product_fav addWishList" data-id="{{ $product->id }}"><i class="fas fa-heart"></i></div>
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
											</div>
										@endforeach
									</div>
									<div class="featured_slider_dots_cover"></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
						<div class="new_arrivals_title">{{ $second_category->category_name }}</div>
							<ul class="clearfix">
								<li class="active"></li>

							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										@foreach($second_arraival_products as $product)
											<div class="featured_slider_item">
												<div class="border_active"></div>
												<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
													<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($product->image_one) }}" alt="" height="120px" width="100px"></div>
													<div class="product_content">
														@if($product->discount_price === NULL)
															<div class="product_price discount">{{ number_format($product->selling_price) }}円</div>
														@else
															<div class="product_price discount">{{ number_format($product->discount_price) }}円<span>{{ number_format($product->selling_price) }}円</span></div>
														@endif
														<div class="product_name"><div><a href="product.html">{{ $product->product_name }}</a></div></div>
														<div class="product_extras">
															<div class="product_color">
																<input type="radio" checked name="product_color" style="background:#b19c83">
																<input type="radio" name="product_color" style="background:#000000">
																<input type="radio" name="product_color" style="background:#999999">
															</div>
															<a href="{{ route('product.detail', ['id' => $product->id, 'product_name' => $product->product_name]) }}">
																<button class="product_cart_button">購入画面へ</button>
															</a>
														</div>
													</div>

													@auth
														<div class="product_fav addWishList" data-id="{{ $product->id }}"><i class="fas fa-heart"></i></div>
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
											</div>
										@endforeach
									</div>
									<div class="featured_slider_dots_cover"></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Adverts -->

	<div class="adverts">
		<div class="container">
			<div class="row">
				@foreach ($articles as $article)
					<div class="col-lg-4 advert_col">
						<div class=""><a href="{{ route('show.article', ['id' => $article->id]) }}"><img src="{{ $article->post_image }}" alt="" class="article_image"></a></div>
						<div class="advert flex-row align-items-center justify-content-start">
							<div class="advert_content">
								<div class="advert_text">{!! $article->details_ja !!}</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="{{ asset('/frontend/images/send.png') }}" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
						<form action="{{ route('store.newsletter') }}" method="POST" class="newsletter_form">
							@csrf
							<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address" name="email">
							<button class="newsletter_button" type="submit">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="cart_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form action="{{ route('insert.into.cart') }}" method="POST">
				@csrf
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">商品プレビュー</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-md-4">
								<div class="card">
									<img src="" alt="" id="view_product_image"  height="200px">
									<div class="card-body">
										<h5 class="card-title text-center" id="view_product_name">商品名</h5>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<ul class="list-group">
									<li class="list-group-item">商品コード：<span id="view_product_code"></span></li>
									<li class="list-group-item">カテゴリー：<span id="view_product_category"></span></li>
									<li class="list-group-item">サブカテゴリー：<span id="view_product_subcategory"></span></li>
									<li class="list-group-item">ブランド：<span id="view_product_brand"></span></li>
									<li class="list-group-item">在庫：<span class="badge view-stock" id="view_product_stock">あり</span></li>
								</ul>
							</div>

							<div class="col-md-4">
								<input type="hidden" name="product_id" id="product_id" value="">

								<div class="form-group">
									<label for="">カラー</label>
									<select name="color" id="color" class="form-control">

									</select>
								</div>

								<div class="form-group">
									<label for="">サイズ</label>
									<select name="size" id="size" class="form-control">

									</select>
								</div>

								<div class="form-group">
									<label for="">数量</label>
									<input type="number" class="form-control" name="qty" value="1">
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
						<button type="submit" class="btn btn-primary">カートに入れる</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.addWishList').on('click', function() {
				var id = $(this).data('id');
				if (id) {
					$.ajax({
						url: " {{ url('add/wishlist') }}/" + id,
						type: "GET",
						dataType: "JSON",
						success: function(data) {
							const Toast = Swal.mixin({
								toast: true,
								position: 'top-end',
								showConfirmButton: false,
								timer: 3000,
								timerProgressBar: true,
								onOpen: (toast) => {
									toast.addEventListener('mouseenter', Swal.stopTimer)
									toast.addEventListener('mouseleave', Swal.resumeTimer)
								}
							});

							Toast.fire({
								icon: data.type,
								title: data.message
							});
						},
					});
				} else {
					alert('danger');
				}
			});
		});
	</script>

@endsection
