<article class="card post post-margins" data-id="{{ $post->id}}">
  <div class="post-header d-flex justify-content-between">
    <a href="/users/{{ $post->author_id }}"><i class="icon-user post-user"></i>{{ $post->name }}</a>
    <a class="delete-post"><i class="icon-trash post-delete"></i></a>
  </div>

  <div class="post-date d-flex justify-content-between">
    <a href="/users/{{ $post->author_id }}">{{ $post->abbrev }}</a>
  </div>

  <div class="card-body">
    {{ $post->content }}
  </div>

  <div class="post-footer">
    <a href="#" class="number-comments">X comments</a>
  </div>
</article>
