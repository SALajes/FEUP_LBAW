<?php $__env->startSection('title', $professor->name); ?>
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/homepage.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>">

<script src=<?php echo e(asset('js/profile_prof.js')); ?> defer></script>

<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.edit_professor_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.rate_prof_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container-fluid">
    <div class="row">
       <?php
            $bc = $professor->abbrev . "'s profile";
            draw_sidebar_Top_prof($bc, $professor);
            draw_sidebar_Profile_prof($likeCounter);
        ?>
        <!-- offset-lg-0 offset-md-2 offset-3 -->
        <div id="content" class="col-12 col-lg-9">
            <div id="nav">
                <div id="tabs" class="nav nav-tabs nav-fill">
                    <a class="nav-item nav-link" href="#" role="button" aria-pressed="true">Teaches</a>
                    <a class="nav-item nav-link" href="#" role="button">Ratings</a>
                </div>
            </div>
            <input id="professor_id" type="hidden" value="<?php echo e($professor->id); ?>" readonly>
            <div id="data"></div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/pcp/Desktop/FEUP/LBAW/resources/views/pages/profile_prof.blade.php ENDPATH**/ ?>