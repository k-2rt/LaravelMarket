@extends('layouts.app')

@section('content')
@include('layouts.menubar')

  <!-- Single Blog Post -->

  <div class="single_post">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="single_post_title">
            @if (Session()->get('lang') === 'japanese')
              {{ $post->post_title_ja }}
            @else
              {{ $post->post_title_en }}
            @endif
          </div>
          <div class="single_post_text">
            <p>
              @if (Session()->get('lang') === 'japanese')
                {!! $post->details_ja !!}
              @else
                {!! $post->details_en !!}
              @endif
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
