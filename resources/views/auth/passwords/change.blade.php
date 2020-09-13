@extends('layouts.app')

@section('content')
<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @if (session('errMessage'))
                    <div class="alert flash-alert" role="alert">
                        {{ session('errMessage') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">パスワード変更</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.change') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="old_password" class="col-md-4 col-form-label text-md-right">現在のパスワード</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="old_password" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">新しいパスワード</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">確認用パスワード</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        パスワードを変更
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="text-center">
                    <img src="{{ asset('/panel/assets/images/user1.jpg') }}" alt="" height="90px" width="90px">
                    </div>

                    <div class="card-body">
                    <h5 class="text-center">{{ Auth::user()->name }}</h5>
                    </div>

                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ route('password.change') }}">パスワードの変更</a></li>
                    <li class="list-group-item">line one</li>
                    <li class="list-group-item">line one</li>
                    </ul>

                    <div class="card-body">
                    <a href="{{ route('user.logout') }}" class="btn btn-secondary btn-sm btn-block font-weight-bold">ログアウト</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
