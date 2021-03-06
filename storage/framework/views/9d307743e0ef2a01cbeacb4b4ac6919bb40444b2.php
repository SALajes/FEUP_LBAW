<?php $__env->startSection('title', 'Landing'); ?>
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/landing.css')); ?>" />

<body>
	<header class="background-gradient-blue">
	<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
	<?php endif; ?>
	
		<section class="masthead mb-auto pt-3 d-flex pr-5 justify-content-end">
			<div class="inner">
				<nav class="nav nav-masthead justify-content-center">
					<a class="nav-link active text-white" href="<?php echo e(url('/')); ?>">Home</a>
					<a class="nav-link text-white" href="<?php echo e(url('/about')); ?>">About</a>
				</nav>
			</div>
		</section>

		<section class="position-relative overflow-hidden p-3 p-md-5 text-center text-white">
			<div class="col-md-5 p-lg-5 mx-auto my-5">
				<i class="icon-logo" style="font-size: 10rem; color: white;"></i>
				<h1 class="font-weight-normal">LBrAWl</h1>
				<p class="lead font-weight-normal">
					The most effective communication experience for university students.
					Chat, share course materials and form groups. All in one platform.
				</p>

				<?php echo $__env->make('partials.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php echo $__env->make('partials.register', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<a id="register_btn" class="btn btn-outline-light" data-toggle="modal" data-target="#registerModal" data-whatever="@mdo"><?php echo e(__('Register')); ?></a>
				<a id="login_btn" class="btn btn-outline-light" data-toggle="modal" data-target="#loginModal" data-whatever="@mdo"><?php echo e(__('Login')); ?></a>
			</div>
			<div class="product-device shadow-sm d-none d-md-block"></div>
			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
		</section>
	</header>

	<main class="container marketing mt-5">
		<!-- START THE FEATURETTES -->
		<section class="row featurette">
			<blockquote class="col-md-7 order-md-2">
				<h2 class="featurette-heading">
					Faster and more fluid group formation.
					<span class="text-info">Without the spam.</span>
				</h2>
				<p class="lead">
					An easy-to-use tool allows you to handpick who you want to join you in
					workgroups. Choose students that work the same way you do, and easily
					check if the students you want to work with aren't yet members of a
					team. This greatly diminishes spam messages of students asking each
					other if they want to team up.
				</p>
			</blockquote>
			<i class="icon-teamwork text-gradient-blue col-md-5 text-center" style="font-size: 10rem;"></i>
		</section>

		<hr class="featurette-divider" />

		<section class="row featurette">
			<blockquote class="col-md-7">
				<h2 class="featurette-heading">
					Help and ask for help.
					<span class="text-info">Anytime, anywhere.</span>
				</h2>
				<p class="lead">
					No more going through several social media groups in order to get
					answers to your questions. LBrAWl provides a structured, fast and
					intuitive interface that allows you to quickly expose your doubts and
					get help from other peers. Don't forget to also lend a helping hand to
					your mates!
				</p>
			</blockquote>
			<i class="icon-partner text-gradient-blue col-md-5 text-center" style="font-size: 10rem;"></i>
		</section>

		<hr class="featurette-divider mt-3" />

		<section class="row featurette">
			<blockquote class="col-md-7 order-md-2">
				<h2 class="featurette-heading">
					Boost self-improvement and encourage your colleagues.
					<span class="text-info">Rate them anonymously.</span>
				</h2>
				<p class="lead">
					One of the biggest obstacles students face is identifying their
					weaknesses. What if fellow students that you have worked with could
					help you with that? And if you've worked hard enough, they can even
					upvote your profile.
				</p>
			</blockquote>
			<i class="icon-goal text-gradient-blue col-md-5 text-center" style="font-size: 10rem;"></i>
		</section>

		<!-- /END THE FEATURETTES -->

		<hr class="featurette-divider mb-4" />
	</main>
</body>

<?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/pcp/Desktop/FEUP/LBAW/resources/views/pages/landing.blade.php ENDPATH**/ ?>