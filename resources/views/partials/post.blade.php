<link rel="stylesheet" href="{{ asset('css/card.css') }}">

<div class="card card-margins" data-id="{{ $post->id}}">
  <div class="card-header d-flex justify-content-between">
    <a href="#"><i class="icon-user post-user"></i>{{ $post->name }}</a>
    <a href="#"><i class="icon-ellipsis"></i></a>
  </div>

  <div class="card-body">
    {{ $post->content }}
  </div>

  <div class="card-footer">
    <a href="#" class="number-comments">X comments</a>
  </div>
</div>