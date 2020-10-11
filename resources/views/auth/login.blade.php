@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_responsive.css') }}">

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="contact_form_container login_form" style="margin-bottom: 40px;">
                    <div class="contact_form_title">会員ログイン</div>
                    <form action="{{ route('login') }}" id="contact_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">メールアドレス or 電話番号</label>
                            <input type="text" class="form-control @error('login_email') is-invalid @enderror" name="email"  aria-describedby="emailHelp" required="">

                            @error('login_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control @error('login_password') is-invalid @enderror" name="password" value="{{ old('login_password') }}"  aria-describedby="emailHelp" required="">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                            <input type="text" class="form-control" placeholder="例）山田太郎" name="name" required="">
                        </div>

                        <div class="form-group">
                            <label for="kana">フリガナ</label>
                            <input type="text" class="form-control" placeholder="例）ヤマダタロウ" name="kana" required="" onBlur="$(this).val(hiraToKana($(this).val()));">
                        </div>

                        <div class="form-group">
                            <label for="phone">電話番号</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  placeholder="例）09012345678" required="" onBlur="$(this).val(check_phone_num($(this).val()));" maxlength="11">
                        </div>

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="例）test@test.com" required="">
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control" placeholder="パスワードを入力してください" name="password" required="">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">確認用パスワード</label>
                            <input type="password" class="form-control" placeholder="確認用パスワードを入力してください"  name="password_confirmation" required="">
                        </div>


                        <div class="form-group">
                            <label for="zip_code">郵便番号<span class="tx-danger">*</span></label>
                            <input type="text" class="form-address" placeholder="例）1001000"  name="zip_code" required="" maxlength="7">
                        </div>

                        <div class="form-group">
                            <label for="prefectures">都道府県<span class="tx-danger">*</span></label>
                            <select name="prefectures" id="" class="form-address" >
                            @foreach ($prefs as $index => $name)
                                <option value="{{ $index }}">{{ $name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address1">住所１<span class="tx-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="市区町村番地"  name="address1" required="">
                        </div>

                        <div class="form-group">
                            <label for="address2">住所２</label>
                            <input type="text" class="form-control" placeholder="建物名"  name="address2">
                        </div>

                        <div class="contact_form_button">
                            <button type="submit" class="btn btn-warning text-white font-weight-bold btn-lg">会員登録</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="col-lg-5 offset-lg-1 ">

            </div> --}}
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

    function check_phone_num(num){
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
