@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/blog_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/blog_responsive.css') }}">

<!-- Article -->

<div class="blog">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="blog_posts d-flex flex-row align-items-start justify-content-between">

          @foreach ($posts as $post)

            <!-- Blog post -->
            <div class="blog_post">
              <div class="blog_image" style="background-image:url({{ asset($post->post_image) }})"></div>
              <div class="blog_text">
                {{ $post->post_title_ja }}
              </div>
              <div class="blog_button">
              <a href="{{ route('show.article', ['id' => $post->id]) }}">
                  続きを読む
                </a>
              </div>
            </div>

          @endforeach

        </div>
      </div>

    </div>
  </div>
</div>


@endsection
