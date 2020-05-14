<article class="card post post-margins" data-id="{{$post->id}}">
  <div class="post-header d-flex justify-content-between">
    <div class="post-header-left">
      <a href="/users/{{ $post->author_id }}"><i class="icon-user post-user-icon"></i>{{ $post->name }}</a>
      <a href="/cu/{{$post->cu_id}}" class="badge badge-pill badge-primary cu-badge">{{ $post->abbrev }}</a>
    </div>

    <a class="delete-post"><i class="icon-trash post-delete"></i></a>
  </div>

  <div class="card-body">
    {{ $post->content }}
  </div>

  <div class="post-footer">
    <a href="/post/{{$post->id}}" class="number-comments">
      <?php
        $hasPrint = false;

        foreach ($numComments as $num) {
          if($num->post_id == $post->id) {
			printf("%d comments", $num->count);
			$hasPrint = true;
		  }
		}
		
		if(!$hasPrint)
			echo("0 comments");
      ?>
    </a>
  </div>
</article>
