<nav class="main_nav">
  <div class="container">
    <div class="row">
      <div class="col">

        <div class="main_nav_content d-flex flex-row">

          <!-- Categories Menu -->

          <div class="cat_menu_container">
            <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
              <div class="cat_burger"><span></span><span></span><span></span></div>
              <div class="cat_menu_text">カテゴリー</div>
            </div>

            <ul class="cat_menu">
              @foreach($categories as $category)
                <li class="hassubs">
                <a href="{{ route('show.category.list', ['id' => $category->id]) }}">{{ $category->category_name }}<i class="fas fa-chevron-right"></i></a>
                  <ul>
                    @foreach($sub_categories as $sub_category)
                      @if($category->id === $sub_category->category_id)
                        <li class="hassubs">
                        <a href="{{ route('show.product.list', ['id' => $sub_category->id]) }}">{{ $sub_category->subcategory_name }}<i class="fas fa-chevron-right"></i></a>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </li>
              @endforeach
            </ul>
          </div>

          <!-- Main Nav Menu -->

          <div class="main_nav_menu ml-auto">
            <ul class="standard_dropdown main_nav_dropdown">
              <li><a href="{{ route('index.article') }}">記事<i class="fas fa-chevron-down"></i></a></li>
              <li><a href="{{ route('contact.page') }}">お問い合わせ<i class="fas fa-chevron-down"></i></a></li>
            </ul>
          </div>

          <!-- Menu Trigger -->

          <div class="menu_trigger_container ml-auto">
            <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
              <div class="menu_burger">
                <div class="menu_trigger_text">menu</div>
                <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</nav>

</header>
