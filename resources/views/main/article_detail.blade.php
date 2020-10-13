@extends('layouts.app')

@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/blog_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/blog_responsive.css') }}">

<div class="contact_form">
  <div class="container article_container">
    <div class="article_category">{{ $post->post_category->category_name_ja }}</div>
    <h3 class="article_title">{{ $post->post_title_ja }}</h3>
    <p>編集スタッフ<span style="margin-left: 10px;">{{ $post->create_user }}</span></p>
    <div class="article_content">
      <p><img src="{{ asset($post->post_image) }}" alt="" class="article_detail_image"></p>
      <p>{!! nl2br($post->details_ja) !!}</p>
    </div>
  </div>

</div>
  <!-- Single Blog Post -->

@endsection
