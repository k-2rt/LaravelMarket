@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_responsive.css')}}">

	<!-- Contact Form -->

	<div class="contact_form">
    <div class="container" style="margin-bottom: 50px;">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="{{ asset('/panel/assets/images/contact_1.png') }}" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">電話番号</div>
              <div class="contact_info_text">{{ $site->phone_one }}</div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="{{ asset('/panel/assets/images/contact_2.png') }}" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">メールアドレス</div>
              <div class="contact_info_text">{{ $site->email }}</div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="{{ asset('/panel/assets/images/contact_3.png') }}" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">住所</div>
              <div class="contact_info_text">{{ $site->company_address }}</div>
							</div>
						</div>

					</div>
				</div>
			</div>
    </div>

		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_form_container">
						<div class="contact_form_title">お問い合わせ情報</div>

            <form action="{{ route('contact.form') }}" id="contact_form" method="POST">
              @csrf
							<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
								<input type="text" id="contact_form_name" class="contact_form_name input_field" placeholder="お名前を入力して下さい" required="required" data-error="Name is required." name="name">

                <input type="text" id="contact_form_email" class="contact_form_email input_field" placeholder="メールアドレスを入力して下さい" required="required" data-error="Email is required." name="email">

                <input type="text" id="contact_form_phone" class="contact_form_phone input_field" placeholder="電話番号を入力して下さい" name="phone">
							</div>
							<div class="contact_form_text">
								<textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="お問い合わせ内容を入力してください" required="required" data-error="Please, write us a message." name="message"></textarea>
							</div>
							<div class="contact_form_button">
								<button type="submit" class="button contact_submit_button">送信する</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
