<article class="card comment" data-id="{{$comment->id}}">
  <div class="comment-header">
    <a href="/users/{{ $comment->author_id }}"><i class="icon-user comment-user-icon"></i>{{ $comment->name }}</a>
  </div>

  <div class="card-body">
    {{ $comment->content }}
  </div>
</article>

<?php  
  $subs = $subcomments->toArray();
  foreach ($subs as $sub) {
    if($comment->id == $sub->parent_id) { ?>
      <article class="card subcomment" data-id="{{$sub->comment_id}}">
        <div class="subcomment-header">
          <a href="/users/{{ $sub->author_id }}"><i class="icon-user post-user-icon"></i>{{ $sub->name }}</a>
        </div>

        <div class="card-body">
          {{ $sub->content }}
        </div>
      </article>
    <?php }
  }
?>