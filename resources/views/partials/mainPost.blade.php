<article class="card post post-margins" data-id="{{ $post[0]->id }}">
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