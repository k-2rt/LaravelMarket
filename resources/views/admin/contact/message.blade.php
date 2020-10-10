@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">メッセージ管理</a>
      <span class="breadcrumb-item active">詳細一覧</span>
    </nav>
    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-20p">名前</th>
                <th class="wd-20p">電話番号</th>
                <th class="wd-20p">メールアドレス</th>
                <th class="wd-35p">メッセージ</th>
                <th class=""></th>
              </tr>
            </thead>
            <tbody>
              @foreach($messages as $message)
                <tr>
                  <td>{{ $message->name }}</td>
                  <td>{{ $message->phone }}</td>
                  <td>{{ $message->email }}</td>
                  <td>{!! $message->message !!}</td>
                  <td>
                    <a href="" class="btn btn-sm btn-info">詳細</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
