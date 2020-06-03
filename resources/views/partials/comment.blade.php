<section id="comment{{$comment->id}}">
	<article class="card comment" data-id="{{$comment->id}}">
		<div class="comment-header">
			<a href="/users/{{ $comment->author_id }}"><i class="icon-user comment-user-icon"></i>{{ $comment->name }}</a>
		</div>

		<div class="card-body">
			{{ $comment->content }}
		</div>
	</article>

	<section class="add-subcomment">
		<div>
			<button class="add-subcomment-button elem-help" type="button" data-toggle="collapse" data-target=".comment{{$comment->id}}" role="button">
				+
			</button>
			<p class="help-tip" style="margin-left:1rem;margin-top:1rem;">Comment Thread</p>
		</div>

		<div class="collapse subcomment-form comment{{$comment->id}}">
			<form class="new-subcomment" data-id="{{$comment->id}}">
				<div class="form-group">
					<textarea class="subcomment-content form-control" rows="1" placeholder="Write a sub comment"></textarea>
				</div>

				<button type="submit" class="btn btn-primary post-subcomment">Make subcomment</button>
			</form>
		</div>
	</section>

	<section id="subcomments{{$comment->id}}">
		<?php
		$subs = $subcomments->toArray();

		foreach ($subs as $sub) {
			if ($comment->id == $sub->parent_id) { ?>

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
	</section>
</section>