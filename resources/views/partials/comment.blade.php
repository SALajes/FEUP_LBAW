<article class="card comment" data-id="{{$comment->id}}">
  <div class="comment-header">
    <a href="/users/{{ $comment->author_id }}"><i class="icon-user comment-user-icon"></i>{{ $comment->name }}</a>
  </div>

  <div class="card-body">
    {{ $comment->content }}
  </div>
</article>

<?php  
  $subcomment = null;
  
  $aux = $subcomments->toArray();
  foreach ($aux as $i) {
    if($comment->id == $i->parent_id)
      $subcomment = $i;
  }
?>

<?php if($subcomment != null) { ?>
  <article class="card subcomment" data-id="{{$subcomment->comment_id}}">
    <div class="subcomment-header">
      <a href="/users/{{ $subcomment->author_id }}"><i class="icon-user post-user-icon"></i>{{ $subcomment->name }}</a>
    </div>

    <div class="card-body">
      {{ $subcomment->content }}
    </div>
  </article>
<?php } ?>