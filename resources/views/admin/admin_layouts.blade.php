<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="https://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="https://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="https://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="https://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <link rel="icon" href="{{ asset('/panel/assets/images/favicon.png') }}">
    <title>日本、暮らしの道具店</title>

    <!-- vendor css -->
    <link href="{{ asset('/backend/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">

    <!-- Tags input CDN CSS -->
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>
    <!-- Toastr CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- Datatable CSS -->
    <link href="{{ asset('/backend/lib/highlightjs/github.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/css/starlight.css') }}">

  </head>

  <body>

    @guest

    @else

      <!-- ########## START: LEFT PANEL ########## -->
      <div class="sl-logo"><a href="">日本、暮らしの道具店</a></div>
      <div class="sl-sideleft">
        <div class="sl-sideleft-menu">
          <a href="{{ url('admin/home') }}" class="sl-menu-link active">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
              <span class="menu-item-label">HOME</span>
            </div>
          </a>

          @if (Auth::user()->category === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">カテゴリー</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">メイン</a></li>
              <li class="nav-item"><a href="{{ route('subcategories') }}" class="nav-link">サブ</a></li>
              <li class="nav-item"><a href="{{ route('brands') }}" class="nav-link">ブランド</a></li>
            </ul>
          @endif

          @if (Auth::user()->product === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
                <span class="menu-item-label">商品</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{ route('create.product') }}" class="nav-link">商品追加</a></li>
              <li class="nav-item"><a href="{{ route('index.product') }}" class="nav-link">商品一覧</a></li>
              <li class="nav-item"><a href="{{ route('admin.product.stock') }}" class="nav-link">商品在庫</a></li>
            </ul>
          @endif

          @if (Auth::user()->article === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
                <span class="menu-item-label">記事</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('index.article.category') }}" class="nav-link">カテゴリー</a></li>
            <li class="nav-item"><a href="{{ route('create.article.post') }}" class="nav-link">投稿</a></li>
              <li class="nav-item"><a href="{{ route('index.article.post') }}" class="nav-link">投稿一覧</a></li>
            </ul>
          @endif

          @if (Auth::user()->coupon === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
                <span class="menu-item-label">クーポン</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{ route('admin.coupon') }}" class="nav-link">一覧</a></li>
            </ul>
          @endif

          @if (Auth::user()->order === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">注文</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{ route('admin.pending.order') }}" class="nav-link">承認待ち</a></li>
              <li class="nav-item"><a href="{{ route('admin.accepted.payment') }}" class="nav-link">支払い完了</a></li>
              <li class="nav-item"><a href="{{ route('admin.process.order') }}" class="nav-link">配達中</a></li>
              <li class="nav-item"><a href="{{ route('admin.delivered.order') }}" class="nav-link">配達済み</a></li>
              <li class="nav-item"><a href="{{ route('admin.cancel.order') }}" class="nav-link">キャンセル</a></li>
            </ul>
          @endif

          @if (Auth::user()->report === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">レポート</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{ route('report.today.order') }}" class="nav-link">注文一覧（本日）</a></li>
              <li class="nav-item"><a href="{{ route('report.delivered.order') }}" class="nav-link">配達済み一覧（本日）</a></li>
              <li class="nav-item"><a href="{{ route('report.month.order') }}" class="nav-link">配達済み一覧（今月）</a></li>
              <li class="nav-item"><a href="{{ route('search.report') }}" class="nav-link">詳細検索</a></li>
            </ul>
          @endif

          @if (Auth::user()->role === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">ユーザー管理</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{ route('admin.create.user') }}" class="nav-link">ユーザー作成</a></li>
              <li class="nav-item"><a href="{{ route('admin.user.lists') }}" class="nav-link">ユーザー一覧</a></li>
            </ul>
          @endif

          @if (Auth::user()->return === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">返品管理</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{ route('admin.request.return') }}" class="nav-link">返品申請</a></li>
              <li class="nav-item"><a href="{{ route('admin.returned.lists') }}" class="nav-link">返品完了</a></li>
            </ul>
          @endif

          @if (Auth::user()->contact === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">メッセージ管理</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.message.lists') }}" class="nav-link">メッセージ一覧</a></li>
            </ul>
          @endif

          @if (Auth::user()->other === '1')
            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">その他</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{ route('admin.newsletter') }}" class="nav-link">ニュース</a></li>
              <li class="nav-item"><a href="{{ route('admin.site.setting') }}" class="nav-link">サイト情報</a></li>
            </ul>
          @endif
        </div>

        <br>
      </div><!-- sl-sideleft -->
      <!-- ########## END: LEFT PANEL ########## -->

      <!-- ########## START: HEAD PANEL ########## -->
      <div class="sl-header">
        <div class="sl-header-left">
          <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
          <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
        </div><!-- sl-header-left -->
        <div class="sl-header-right">
          <nav class="nav">
            <div class="dropdown">
              <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::user()->name }}</span>
                <img src="{{ asset('/backend/img/test-account.jpg') }}" class="wd-32 rounded-circle" alt="">
              </a>
              <div class="dropdown-menu dropdown-menu-header wd-200">
                <ul class="list-unstyled user-profile-nav">
                  <li><a href=""><i class="icon ion-ios-person-outline"></i>プロフィール</a></li>
                  <li><a href="{{ route('admin.password.change') }}"><i class="icon ion-ios-gear-outline"></i>パスワード変更</a></li>
                  <li><a href="{{ route('admin.logout') }}"><i class="icon ion-power"></i> ログアウト</a></li>
                </ul>
              </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
          </nav>
          {{-- <div class="navicon-right">
            <a id="btnRightMenu" href="" class="pos-relative">
              <i class="icon ion-ios-bell-outline"></i>
              <!-- start: if statement -->
              <span class="square-8 bg-danger"></span>
              <!-- end: if statement -->
            </a>
          </div><!-- navicon-right --> --}}
        </div><!-- sl-header-right -->
      </div><!-- sl-header -->
      <!-- ########## END: HEAD PANEL ########## -->

      <!-- ########## START: RIGHT PANEL ########## -->
      <div class="sl-sideright">
        <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>
          </li>
        </ul><!-- sidebar-tabs -->

      </div><!-- sl-sideright -->
      <!-- ########## END: RIGHT PANEL ########## --->

    @endguest

    @yield('admin_content')

    <script src="{{ asset('/backend/lib/jquery/jquery.js') }}"></script>
    {{-- <script src="{{ asset('/backend/lib/popper.js/popper.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('/backend/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('/backend/lib/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('/backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>

    <script src="{{ asset('/backend/lib/highlightjs/highlight.pack.js') }}"></script>
    <script src="{{ asset('/backend/lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/backend/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('/backend/lib/select2/js/select2.min.js') }}"></script>

    <script>
      $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: '検索',
            sSearch: '',
            lengthMenu: '_MENU_',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>


    <script src="{{ asset('/backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('/backend/lib/d3/d3.js') }}"></script>
    <script src="{{ asset('/backend/lib/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('/backend/lib/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('/backend/lib/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('/backend/lib/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('/backend/lib/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('/backend/lib/flot-spline/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('/backend/lib/medium-editor/medium-editor.js') }}"></script>

    <script src="{{ asset('/backend/js/starlight.js') }}"></script>
    <script src="{{ asset('/backend/js/ResizeSensor.js') }}"></script>
    <script src="{{ asset('/backend/js/dashboard.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script>

      @if (Session::has('message'))
          var type = "{{ Session::get('alert-type', 'info') }}"
          switch(type) {
              case 'info':
              toastr.info(" {{ Session::get('message') }} ");
              break;

              case 'success':
              toastr.success(" {{ Session::get('message') }} ");
              break;

              case 'warning':
              toastr.warning(" {{ Session::get('message') }} ");
              break;

              case 'error':
              toastr.error(" {{ Session::get('message') }} ");
              break;
          }
      @endif
    </script>

    <script>
      $(document).on("click", "#delete", function(e){
          e.preventDefault();
          var link = $(this).attr("href");
          swal({
            title: "本当に削除しますか？",
            text: "削除すると, 復元することは出来ません。",
            icon: "warning",
            buttons: ["いいえ", 'はい'],
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                  window.location.href = link;
            } else {
              swal("キャンセルしました。");
            }
          });
        });

        $(document).on("click", "#approve", function(e){
          e.preventDefault();
          var link = $(this).attr("href");
          swal({
            title: "本当に承認しますか？",
            icon: "warning",
            buttons: ["いいえ", 'はい'],
            dangerMode: false,
          })
          .then((willDelete) => {
            if (willDelete) {
                  window.location.href = link;
            } else {
              swal("キャンセルしました。");
            }
          });
        });
    </script>

  </body>
</html>
