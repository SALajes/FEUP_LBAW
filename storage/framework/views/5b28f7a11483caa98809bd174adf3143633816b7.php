<?php $__env->startSection('title', 'Homepage'); ?>
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/homepage.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/post.css')); ?>">

<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fluid">
	<div id="homepage" class="row justify-content-md-center">

		<?php

		use Illuminate\Support\Facades\Auth;

		draw_sidebar_Top("Home", Auth::user()->id, Auth::user()->name, Auth::user()->student_number);
		?>

		<section id="MyCUs">
			<h4 class="text-center">My CU's</h4>
			<ul>
				<?php echo $__env->renderEach('partials.cu_list', $cus, 'cu'); ?>
			</ul>
		</section>
		</aside>

		<main id="mainArea" class="col-12 col-lg-6">
			<div>
				<?php echo $__env->make('partials.publish_card', ['where'=>"public"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<!-- <hr id="post-division"> -->

			<section id="posts">
				<?php echo $__env->make('partials.post', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</section>
			<section id="pages">
				<?php echo e($posts->links()); ?>

			</section>
		</main>

		<section class="col-3">
		</section>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/meias/Work/GitHub/lbaw2013/resources/views/pages/homepage.blade.php ENDPATH**/ ?>