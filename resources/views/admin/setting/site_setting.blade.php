@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">サイト管理</a>
      <span class="breadcrumb-item active">サイト設定</span>
    </nav>

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">
          <a href="{{ route('admin.user.lists') }}" class="btn btn-success btn-sm pull-right">サイト設定</a>
        </h6>

        <form action="{{ route('update.site.setting', ['id' => $setting->id]) }}" method="POST">
          @csrf

          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">電話番号１: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="tel"  name="phone_one" placeholder="例）09012345678" required="" onBlur="$(this).val(check_phone_num($(this).val()));" maxlength="11" value="{{ $setting->phone_one }}">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">電話番号２:</label>
                  <input class="form-control" type="tel"  name="phone_two" placeholder="例）09012345678" required="" onBlur="$(this).val(check_phone_num($(this).val()));" maxlength="11" value="{{ $setting->phone_two }}">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">メールアドレス: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="email" name="email" placeholder="例）test@test.com" required="" value="{{ $setting->email }}">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">会社名: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="company_name" required="" value="{{ $setting->company_name }}">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">会社住所: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="company_address" required="" value="{{ $setting->company_address }}">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Facebook:</label>
                  <input class="form-control" type="text" name="facebook" required="" value="{{ $setting->facebook }}">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Youtube:</label>
                  <input class="form-control" type="text" name="youtube" required="" value="{{ $setting->youtube }}">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Instagram:</label>
                  <input class="form-control" type="text" name="instagram" required="" value="{{ $setting->instagram }}">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Twitter:</label>
                  <input class="form-control" type="text" name="twitter" required="" value="{{ $setting->twitter }}">
                </div>
              </div>

            </div>
            <hr>
            <br>

            <div class="row">

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
