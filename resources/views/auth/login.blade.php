@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_responsive.css') }}">

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="contact_form_container login_form" style="margin-bottom: 40px;">
                    @error('login')
                        <span class="login_feedback" role="role">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="contact_form_title">会員ログイン</div>
                    <form action="{{ route('login') }}" id="contact_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">メールアドレス</label>
                            <input type="text" class="form-control @error('login') is-invalid @enderror" name="email"  aria-describedby="emailHelp" required="" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control @error('login') is-invalid @enderror" name="password" value="{{ old('password') }}" required="">
                        </div>

                        <div class="contact_form_button">
                            <button type="submit" class="btn btn-warning  text-white font-weight-bold btn-lg">ログイン</button>
                        </div>
                    </form><br>
                    <a href="{{ route('password.request') }}">パスワードをお忘れの方はこちらへ</a><br /><br />
                    <a href="{{ url('/login/redirect/facebook') }}" class="btn btn-primary btn-block"><i class="fab fa-facebook-square"></i> Facebook でログイン</a><br>
                    <a href="{{ url('/login/redirect/google') }}" class="btn btn-danger btn-block"><i class="fab fa-google"></i> Google でログイン</a>
                </div>

                <div class="contact_form_container login_form">
                    <div class="contact_form_title">新規会員登録</div>
                    <form action="{{ route('register') }}" id="contact_form" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">お名前</label>
                            <input type="text" class="form-control" placeholder="例）山田太郎" name="name" required="" value="{{ old('name') }}">
                            @error('name')
                                <span class="register_feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kana">フリガナ</label>
                            <input type="text" class="form-control" placeholder="例）ヤマダタロウ" name="kana" required="" value="{{ old('kana') }}" onBlur="$(this).val(hiraToKana($(this).val()));">
                            @error('kana')
                                <span class="register_feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">電話番号</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  placeholder="例）09012345678" required="" onBlur="$(this).val(check_only_num($(this).val()));" maxlength="11">
                            @error('phone')
                                <span class="register_feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="register_email" value="{{ old('register_email') }}" aria-describedby="emailHelp" placeholder="例）test@test.com" required="">
                            @error('email')
                                <span class="register_feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="パスワードを入力してください" name="register_password" required="" value="{{ old('register_password') }}">
                            @error('password')
                                <span class="register_feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">確認用パスワード</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="確認用パスワードを入力してください"  name="password_confirmation" required="">
                        </div>

                        <div class="form-group">
                            <label for="zip_code">郵便番号<span class="tx-danger">*</span></label>
                            <input type="text" class="form-address @error('zip_code') is-invalid @enderror" placeholder="例）1001000" name="zip_code" value="{{ old('zip_code') }}" required="" maxlength="7" onBlur="$(this).val(check_only_num($(this).val()));">
                            @error('zip_code')
                                <span class="register_feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prefectures">都道府県<span class="tx-danger">*</span></label>
                            <select name="prefectures" id="" class="form-address @error('prefectures') is-invalid @enderror" >
                                @foreach ($prefs as $index => $name)
                                    <option value="{{ $index }}" {{ old('prefectures') == $index ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('prefectures')
                                <span class="register_feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address1">住所１<span class="tx-danger">*</span></label>
                            <input type="text" class="form-control @error('address1') is-invalid @enderror" placeholder="市区町村番地" name="address1" value="{{ old('address1') }}" required="">
                            @error('address1')
                                <span class="register_feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address2">住所２</label>
                            <input type="text" class="form-control @error('address2') is-invalid @enderror" placeholder="建物名" name="address2" value="{{ old('address2') }}" >
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

<script>
    function hiraToKana(str) {
        return str.replace(/[\u3041-\u3096]/g, function(match) {
            var chr = match.charCodeAt(0) + 0x60;
            return String.fromCharCode(chr);
        });
    }

    function check_only_num(num){
        let value = num;
        value = value
            .replace(/[０-９]/g, function(s) {
                return String.fromCharCode(s.charCodeAt(0) - 65248);
            })
            .replace(/[^0-9]/g, '');
        return value;
    }
</script>

@endsection
