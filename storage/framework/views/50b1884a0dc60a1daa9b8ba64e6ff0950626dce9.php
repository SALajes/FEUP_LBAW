<?php $__env->startSection('title', 'PostPage'); ?>
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/homepage.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/mainPost.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/comment.css')); ?>">

<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">
        <?php

        use Illuminate\Support\Facades\Auth;

        draw_sidebar_Top("Post", Auth::user()->id, Auth::user()->name, Auth::user()->student_number);
        ?>
        <section></section>
        </aside>

        <main id="mainArea" class="col-12 col-lg-6">
            <?php echo $__env->make('partials.mainPost', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <section id="comments">
                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('partials.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </section>
        </main>

        <section class="col-3">
        </section>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/simawatt/Documents/FEUP/lbaw2013/resources/views/pages/postpage.blade.php ENDPATH**/ ?>