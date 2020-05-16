<article class="card comment" data-id="{{$comment->id}}">
  <div class="comment-header">
    <a href="/users/{{ $comment->author_id }}"><i class="icon-user comment-user-icon"></i>{{ $comment->name }}</a>
  </div>

  <div class="card-body">
    {{ $comment->content }}
  </div>
</article>

<section class="add-subcomment">
	<button class="btn btn-primary add-subcomment-button" type="button" data-toggle="collapse" data-target=".subcomment-form" role="button" aria-expanded="false" aria-controls="subcomment-form">
        +
    </button>
    
    <div class="collapse subcomment-form">
        <form class="new-subcomment" data-id="{{$comment->id}}">
            <div class="form-group">
                <textarea class="subcomment-content form-control" rows="1" placeholder="Write a sub comment"></textarea>
            </div>
            
            <button id="post-subcomment" type="submit" class="btn btn-primary">Make comment</button>
        </form>
    </div>
</section>

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