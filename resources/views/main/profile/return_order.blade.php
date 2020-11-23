@extends('layouts.app')

@section('content')

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-8 card overflow">
                <table class="table table-response">
                    <thead>
                        <tr >
                            <th scope="col">注文日</th>
                            <th scope="col">支払いID</th>
                            <th scope="col">料金</th>
                            <th scope="col">返品状況</th>
                            <th scope="col">ステータス</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td scope="col">{{ $order->order_date }}</td>
                                <td scope="col">{{ $order->payment_id }}</td>
                                <td scope="col">{{ $order->total_delimiter }}円</td>
                                <td scope="col">
                                    @if ($order->return_status === '0')
                                        <span class="badge badge-info">未対応</span>
                                    @elseif ($order->return_status === '1')
                                        <span class="badge badge-warning" style="color: #fff;">承認待ち</span>
                                    @elseif ($order->return_status === '2')
                                        <span class="badge badge-success">返品完了</span>
                                    @endif
                                </td>
                                <td scope="col">
                                    @if ($order->status === '0')
                                        <span class="badge badge-warning" style="color: #fff;">承認待ち</span>
                                    @elseif ($order->status === '1')
                                        <span class="badge badge-info">支払い完了</span>
                                    @elseif ($order->status === '2')
                                        <span class="badge badge-warning" style="color: #fff;">配達中</span>
                                    @elseif ($order->status === '3')
                                        <span class="badge badge-success">配達済み</span>
                                    @else
                                        <span class="badge badge-danger">キャンセル</span>
                                    @endif
                                </td>
                                <td scope="col">
                                    @if ($order->return_status === '0')
                                        <a href="{{ route('request.return.order', ['id' => $order->id]) }}" class="btn btn-danger" id="return">返品申請</a>
                                    @elseif ($order->return_status === '1')
                                        <a href="#" class="btn btn-warning" style="color: #fff;">承認待ち</a>
                                    @elseif ($order->return_status === '2')
                                        <a href="#" class="btn btn-success">返品完了</a>
                                    @endif
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
                        <li class="list-group-item"><a href="{{ route('show.profile.page') }}">ユーザー設定</a></li>
                        <li class="list-group-item"><a href="{{ route('password.change') }}">パスワードの変更</a></li>
                        <li class="list-group-item"><a href="{{ route('return.order.lists') }}">商品返品</a></li>
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
