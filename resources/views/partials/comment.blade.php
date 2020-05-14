<article class="card post post-margins comment" data-id="{{$comment->id}}">
  <div class="post-header d-flex justify-content-between">
    <div class="post-header-left">
      <a href="/users/{{ $comment->author_id }}"><i class="icon-user post-user-icon"></i>{{ $comment->name }}</a>
    </div>
  </div>

  <div class="card-body">
    {{ $comment->content }}
  </div>

  <div class="post-footer">
  </div>
</article>
