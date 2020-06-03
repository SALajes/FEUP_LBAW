<?php $__env->startSection('title', $student->name); ?>
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/homepage.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/post.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/identity.css')); ?>">

<script src=<?php echo e(asset('js/profile.js')); ?> defer></script>

<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.edit_profile_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.rate_student_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fluid">
    <div class="row">
        <?php
        $bc = "Profile";
        if ($owner) $bc = "My " . $bc;
        draw_sidebar_Top($bc, $student->id, $student->name, $student->student_number);
        draw_sidebar_Profile($student->bio, $likeCounter, $owner);
        ?>

        <!-- offset-lg-0 offset-md-2 offset-3 -->

        <div id="profileArea" class="col-12 col-lg-9">
            <div id="nav">
                <div id="tabs" class="nav nav-tabs nav-fill">
                    <a class="nav-item nav-link" href="#" role="button" aria-pressed="true">My CUs</a>
                    <a class="nav-item nav-link" href="#" role="button">My Ratings</a>
                    <?php

                    use Illuminate\Support\Facades\Auth;

                    if ($owner && Auth::user()->administrator) { ?>
                        <a class="nav-item nav-link" href="#" role="button">Manage CUs</a>
                        <script src=<?php echo e(asset('js/admin.js')); ?> defer></script>
                    <?php } ?>
                </div>
            </div>

            <input id="student_id" type="hidden" value="<?php echo e($student->id); ?>">
            <div id="data"></div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/simawatt/Documents/FEUP/lbaw2013/resources/views/pages/profile.blade.php ENDPATH**/ ?>