<div class="card publish-card">
	<form class="new_post">
		<div class="post-header form-group">
			<?php
			if ($where == "public") echo "Posting publicly";
			else echo "Posting to: " . $where;
			?>

		</div>

		<div class="card-body form-group">
			<textarea class="form-control post-content" placeholder="What's on your mind?" rows="3"></textarea>
		</div>

		<div class="post-footer d-flex flex-row-reverse">
			<button id="post_btn" type="submit" class="btn btn-primary">
				Post
			</button>
		</div>
	</form>
</div><?php /**PATH /home/meias/Work/GitHub/lbaw2013/resources/views/partials/publish_card.blade.php ENDPATH**/ ?>