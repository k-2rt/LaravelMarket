@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">ユーザー管理</a>
      <a class="breadcrumb-item" href="{{ route('admin.user.lists') }}">ユーザー 一覧</a>
      <span class="breadcrumb-item active">ユーザー 作成</span>
    </nav>

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">
          <a href="{{ route('admin.user.lists') }}" class="btn btn-success btn-sm pull-right">ユーザー 一覧</a>
        </h6>

        <form action="{{ route('update.admin.user', ['id' => $user->id ]) }}" method="POST">
          @csrf

          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">フリガナ: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="kana" placeholder="例）ヤマダタロウ" required="" value="{{ $user->kana }}" onBlur="$(this).val(hiraToKana($(this).val()));">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">名前: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name" placeholder="例）山田太郎" required="" value="{{ $user->name }}">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">電話番号: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="tel"  name="phone" placeholder="例）09012345678" required="" onBlur="$(this).val(check_phone_num($(this).val()));" maxlength="11" value="{{ $user->phone }}">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">メールアドレス: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="email" name="email" placeholder="例）test@test.com" required="" value="{{ $user->email }}">
                </div>
              </div>

            </div>
            <hr>
            <br>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="category" value="1" {{ $user->category === '1' ? 'checked' : '' }}>
                  <span>カテゴリー</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="coupon" value="1" {{ $user->coupon === '1' ? 'checked' : '' }}>
                  <span>クーポン</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="product" value="1" {{ $user->product === '1' ? 'checked' : '' }}>
                  <span>商品</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="article" value="1" {{ $user->article === '1' ? 'checked' : '' }}>
                  <span>記事</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="order" value="1" {{ $user->order === '1' ? 'checked' : '' }}>
                  <span>注文</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="other" value="1" {{ $user->other === '1' ? 'checked' : '' }}>
                  <span>その他</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="report" value="1" {{ $user->report === '1' ? 'checked' : '' }}>
                  <span>リポート</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="role" value="1" {{ $user->role === '1' ? 'checked' : '' }}>
                  <span>Role</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="return" value="1" {{ $user->return === '1' ? 'checked' : '' }}>
                  <span>Return</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="contact" value="1" {{ $user->contact === '1' ? 'checked' : '' }}>
                  <span>Contact</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="comment" value="1" {{ $user->comment === '1' ? 'checked' : '' }}>
                  <span>Comment</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="setting" value="1" {{ $user->setting === '1' ? 'checked' : '' }}>
                  <span>Setting</span>
                </label>
              </div>
            </div>
            <br/>
            <br/>

            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">更新する</button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </form>
      </div>
    </div>
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

@endsection
