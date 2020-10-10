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

      <form action="{{ route('store.admin.user') }}" method="POST">
          @csrf

          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">フリガナ: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="kana" placeholder="例）ヤマダタロウ" required="" onBlur="$(this).val(hiraToKana($(this).val()));">
                </div>
                <div class="form-group">
                  <label class="form-control-label">名前: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="name" placeholder="例）山田太郎" required="">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">電話番号: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="tel"  name="phone" placeholder="例）09012345678" required="" onBlur="$(this).val(check_phone_num($(this).val()));" maxlength="11">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">メールアドレス: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="email" name="email" placeholder="例）test@test.com" required="">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">パスワード: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="password" name="password" placeholder="パスワードを入力してください" required="">
                </div>
              </div>

            </div>
            <hr>
            <br>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="category" value="1">
                  <span>カテゴリー</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="coupon" value="1">
                  <span>クーポン</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="product" value="1">
                  <span>商品</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="article" value="1">
                  <span>記事</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="order" value="1">
                  <span>注文</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="other" value="1">
                  <span>その他</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="report" value="1">
                  <span>リポート</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="role" value="1">
                  <span>ユーザー管理</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="return" value="1">
                  <span>返品管理</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="contact" value="1">
                  <span>Contact</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="comment" value="1">
                  <span>コメント管理</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="setting" value="1">
                  <span>サイト管理</span>
                </label>
              </div>

              <div class="col-lg-4">
                <label class="ckbox">
                  <input type="checkbox" name="stock" value="1">
                  <span>在庫管理</span>
                </label>
              </div>

            </div>
            <br/>
            <br/>

            <div class="form-layout-footer">
              <button class="btn btn-info mg-r-5" type="submit">追加する</button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
        </form>
      </div>
    </div>
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

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
