<article class="card post" data-id="<?php echo e($post[0]->id); ?>">
    <div class="post-header d-flex justify-content-between">
        <div class="post-header-left">
            <a href="/users/<?php echo e($post[0]->author_id); ?>" class="post-user"><i class="icon-user post-user-icon"></i><?php echo e($post[0]->name); ?></a>
            <a href="/cu/<?php echo e($post[0]->cu_id); ?>" class="badge badge-pill badge-primary cu-badge"><?php echo e($post[0]->abbrev); ?></a>
        </div>
    </div>

    <div class="card-body post-body">
        <?php echo e($post[0]->content); ?>

    </div>

    <div class="post-footer">
        <a href="/post/<?php echo e($post[0]->id); ?>" class="number-comments">
            <?php printf("%d comments", $numComments[0]->count) ?>
        </a>
    </div>
</article>

<section class="add-comment">
    <button class="add-comment-button" type="button" data-toggle="collapse" data-target="#collapseForm" role="button" aria-expanded="false" aria-controls="collapseForm">
        +
    </button>
    
    <div id="collapseForm" class="collapse">
        <form class="newComment">
            <div class="form-group">
                <textarea class="comment-content form-control" rows="1" placeholder="Write a comment"></textarea>
            </div>
            
            <button id="postComment" type="submit" class="btn btn-primary">Make comment</button>
        </form>
    </div>
</section><?php /**PATH /home/simawatt/Documents/FEUP/lbaw2013/resources/views/partials/mainPost.blade.php ENDPATH**/ ?>