@extends('layouts.app')

@section('content')

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-8 card profile-height overflow">
                <table class="table table-response">
                    <thead>
                        <tr >
                            <th scope="col">支払いID</th>
                            <th scope="col">料金</th>
                            <th scope="col">注文日</th>
                            <th scope="col">ステータス</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td scope="col">{{ $order->payment_id }}</td>
                                <td scope="col">{{ $order->total_delimiter }}円</td>
                                <td scope="col">{{ $order->order_date }}</td>
                                <td scope="col">
                                    @if ($order->status === '0')
                                        <span class="badge badge-warning">承認待ち</span>
                                    @elseif ($order->status === '1')
                                        <span class="badge badge-info">支払い完了</span>
                                    @elseif ($order->status === '2')
                                        <span class="badge badge-warning">配達中</span>
                                    @elseif ($order->status === '3')
                                        <span class="badge badge-success">配達済み</span>
                                    @else
                                        <span class="badge badge-danger">キャンセル</span>
                                    @endif
                                </td>
                                <td scope="col">
                                <a href="{{ route('tracking.order', ['id' => $order->id]) }}" class="btn btn-info">詳細</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-4">
                <div class="card profile-height">
                    <div class="text-center">
                        <img src="{{ asset('/panel/assets/images/user1.jpg') }}" alt="" height="90px" width="90px">
                    </div>
                    <div class="card-body">
                        <h5 class="text-center">{{ Auth::user()->name }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{ route('password.change') }}">パスワードの変更</a></li>
                        <li class="list-group-item"><a href="{{ route('show.address.page') }}">住所の設定</a></li>
                        <li class="list-group-item"><a href="{{ route('success.order.lists') }}">商品返品</a></li>
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
