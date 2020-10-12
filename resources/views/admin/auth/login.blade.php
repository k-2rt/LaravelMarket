@extends('admin.admin_layouts')

@section('admin_content')

  <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Laravel <span class="tx-info tx-normal">Market</span></div>
      <div class="tx-center mg-b-60">日本、暮らしの道具店</div>

      <form action="{{ route('admin.login') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="password">パスワード</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror

        </div><!-- form-group -->
        <button type="submit" class="btn btn-info btn-block">ログイン</button>

      </form>

    </div><!-- login-wrapper -->
  </div><!-- d-flex -->

@endsection
