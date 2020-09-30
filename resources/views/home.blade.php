@extends('layouts.app')

@section('content')

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-8 card">
                <table class="table table-response">
                    <thead>
                        <tr >
                            <th scope="col" style="vertical-align: middle;">支払い方法</th>
                            <th scope="col" style="vertical-align: middle;">支払いID</th>
                            <th scope="col" style="vertical-align: middle;">料金</th>
                            <th scope="col" style="vertical-align: middle;">注文日</th>
                            <th scope="col" style="vertical-align: middle;">ステータス<br />コード</th>
                            <th scope="col" style="vertical-align: middle;">アクション</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td scope="col">{{ $order->payment_type }}</td>
                                <td scope="col">{{ $order->payment_id }}</td>
                                <td scope="col">{{ $order->total_delimiter }}円</td>
                                <td scope="col">{{ $order->order_date }}</td>
                                <td scope="col">{{ $order->status_code }}</td>
                                <td scope="col">
                                    <a href="" class="btn btn-info">詳細</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    <li class="list-group-item"><a href="{{ route('show.address.page') }}">住所の設定</a></li>
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
