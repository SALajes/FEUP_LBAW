<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<article class="card post post-margins" data-id="<?php echo e($post->id); ?>">
	<div class="post-header d-flex justify-content-between">
		<div class="post-header-left">
			<a href="/users/<?php echo e($post->author_id); ?>"><i class="icon-user post-user-icon"></i><?php echo e($post->name); ?></a>
			<a href="/cu/<?php echo e($post->cu_id); ?>" class="badge badge-pill badge-primary cu-badge"><?php echo e($post->abbrev); ?></a>
		</div>

		<?php
			if (Auth::user()->administrator != null || Auth::user()->id == $post->author_id) { ?>
				<div>
					<a class="delete-post elem-help"><i class="icon-trash post-delete"></i></a>
					<p class="help-tip" style="margin-top:0.5rem;">Delete Post</p>
				</div>
		<?php } else {
			echo ("");
		} ?>
	</div>

	<div class="card-body">
		<?php echo e($post->content); ?>

	</div>

	<div class="post-footer">
		<a href="/post/<?php echo e($post->id); ?>" class="number-comments">
			<?php
			$hasPrint = false;

			foreach ($numComments as $num) {
				if ($num->post_id == $post->id) {
					printf("%d comments", $num->count);
					$hasPrint = true;
				}
			}

			if (!$hasPrint)
				echo ("0 comments");
			?>
		</a>
	</div>
</article>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/simawatt/Documents/FEUP/lbaw2013/resources/views/partials/post.blade.php ENDPATH**/ ?>