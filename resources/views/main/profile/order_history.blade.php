
@extends('layouts.app')

@section('content')

    <div class="contact_form">
        <div class="container">
            <div class="row">
                @if ($orders->isEmpty())
                    <div class="col-12 text-center">
                        <h4>注文履歴はありません。</h4>
                    </div>
                @else
                    @foreach ($orders as $order)
                        <div class="col-12 card" style="background-color: #e9ecef;">
                            <table class="table table-response" style="margin-bottom: 0;">
                                <tr>
                                    <th width="15%">注文日 <br />{{ $order->order_date }}</th>
                                    <th width="15%">注文合計 <br />{{ $order->total_delimiter }}円</th>
                                    <th width="20%">ステータスコード <br />{{ $order->status_code }}</th>
                                    <th>
                                        <a href="{{ route('tracking.order', ['id' => $order->id]) }}" class="btn btn-info" style="float: right;">詳細</a>
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 card" style="margin-bottom: 30px;">
                            <table class="table table-response">
                                <thead>
                                    <tr>
                                        <th scope="col" width="30%">商品</th>
                                        <th scope="col" width="15%">カラー</th>
                                        <th scope="col" width="20%">サイズ</th>
                                        <th scope="col" width="15%">個数</th>
                                        <th scope="col">価格</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->order_details as $detail)
                                        <tr>
                                            <td scope="col"><img src="{{ Storage::disk('s3')->url($detail->product->image_one) }}" height="50px;" width="50px;" style="margin-right: 10px;"> {{ $detail->product_name }}</td>
                                            <td scope="col">{{ $detail->color }}</td>
                                            <td scope="col">{{ $detail->size }}</td>
                                            <td scope="col">{{ $detail->quantity }}</td>
                                            <td scope="col">{{ $detail->unit_delimiter }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
