<link rel="stylesheet" href="{{ asset('css/help.css') }}">

<article class="card post" data-id="{{ $post[0]->id }}">
    <div class="post-header d-flex justify-content-between">
        <div class="post-header-left">
            <a href="/users/{{ $post[0]->author_id }}" class="post-user"><i class="icon-user post-user-icon"></i>{{ $post[0]->name }}</a>
            <a href="/cu/{{ $post[0]->cu_id}}" class="badge badge-pill badge-primary cu-badge">{{ $post[0]->abbrev }}</a>
        </div>
    </div>

    <div class="card-body post-body">
        {{ $post[0]->content }}
    </div>

    <div class="post-footer">
        <a href="/post/{{ $post[0]->id }}" class="number-comments">
            <?php printf("%d comments", $numComments[0]->count) ?>
        </a>
    </div>
</article>

<section class="add-comment">
    <div>
        <button class="add-comment-button elem-help" type="button" data-toggle="collapse" data-target="#collapseForm" role="button" aria-expanded="false" aria-controls="collapseForm">
            +
        </button>
        <p class="help-tip" style="margin-left:1rem;margin-top:2rem;">Comment Post</p>
    </div>

    <div id="collapseForm" class="collapse">
        <form class="newComment">
            <div class="form-group">
                <textarea class="comment-content form-control" rows="1" placeholder="Write a comment"></textarea>
            </div>

            <button id="postComment" type="submit" class="btn btn-primary">Make comment</button>
        </form>
    </div>
</section>