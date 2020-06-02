<section id="comment<?php echo e($comment->id); ?>">
	<article class="card comment" data-id="<?php echo e($comment->id); ?>">
		<div class="comment-header">
			<a href="/users/<?php echo e($comment->author_id); ?>"><i class="icon-user comment-user-icon"></i><?php echo e($comment->name); ?></a>
		</div>

		<div class="card-body">
			<?php echo e($comment->content); ?>

		</div>
	</article>

	<section class="add-subcomment">
		<button class="add-subcomment-button" type="button" data-toggle="collapse" data-target=".comment<?php echo e($comment->id); ?>" role="button">
			+
		</button>

		<div class="collapse subcomment-form comment<?php echo e($comment->id); ?>">
			<form class="new-subcomment" data-id="<?php echo e($comment->id); ?>">
				<div class="form-group">
					<textarea class="subcomment-content form-control" rows="1" placeholder="Write a sub comment"></textarea>
				</div>

				<button type="submit" class="btn btn-primary post-subcomment">Make subcomment</button>
			</form>
		</div>
	</section>

	<section id="subcomments<?php echo e($comment->id); ?>">
		<?php
		$subs = $subcomments->toArray();

		foreach ($subs as $sub) {
			if ($comment->id == $sub->parent_id) { ?>

				<article class="card subcomment" data-id="<?php echo e($sub->comment_id); ?>">
					<div class="subcomment-header">
						<a href="/users/<?php echo e($sub->author_id); ?>"><i class="icon-user post-user-icon"></i><?php echo e($sub->name); ?></a>
					</div>

					<div class="card-body">
						<?php echo e($sub->content); ?>

					</div>
				</article>

		<?php }
		}
		?>
	</section>
</section><?php /**PATH /home/simawatt/Documents/FEUP/lbaw2013/resources/views/partials/comment.blade.php ENDPATH**/ ?>