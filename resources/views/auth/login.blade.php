@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_responsive.css') }}">

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1 login_form">
                <div class="contact_form_container">
                    <div class="contact_form_title">会員ログイン</div>
                    <form action="{{ route('login') }}" id="contact_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">メールアドレス or 電話番号</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  aria-describedby="emailHelp" required="">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  aria-describedby="emailHelp" required="">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="contact_form_button">
                            <button type="submit" class="btn btn-warning  text-white font-weight-bold btn-lg">会員ログイン</button>
                        </div>
                    </form><br>
                    <a href="{{ route('password.request') }}">パスワードをお忘れの方はこちらへ</a><br /><br />
                    <button type="submit" class="btn btn-primary btn-block"><i class="fab fa-facebook-square"></i> Facebook でログイン</button><br>
                    <button type="submit" class="btn btn-danger btn-block"><i class="fab fa-google"></i> Google でログイン</button>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1 login_form">
                <div class="contact_form_container">
                    <div class="contact_form_title">新規会員登録</div>
                    <form action="{{ route('register') }}" id="contact_form" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">フルネーム</label>
                            <input type="text" class="form-control" placeholder="フルネームを入力してください"  name="name" required="">
                        </div>

                        <div class="form-group">
                            <label for="phone">電話番号</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  placeholder="電話番号を入力してください"  required="">
                        </div>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  aria-describedby="emailHelp" placeholder="メールアドレスを入力してください " required="">
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control" placeholder="パスワードを入力してください"  name="password" required="">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">確認用パスワード</label>
                            <input type="password" class="form-control" placeholder="確認用パスワードを入力してください"  name="password_confirmation" required="">
                        </div>

                        <div class="contact_form_button">
                            <button type="submit" class="btn btn-warning text-white font-weight-bold btn-lg">会員登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
