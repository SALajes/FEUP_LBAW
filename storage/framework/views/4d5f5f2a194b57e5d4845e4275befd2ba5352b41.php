<link rel="stylesheet" href="<?php echo e(asset('css/homepage.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/post.css')); ?>">



<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.rate_cu_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', 'CU Page'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <?php
            use Illuminate\Support\Facades\Auth;
            draw_sidebar_Top_CU($cu, $teachers);
            draw_sidebar_CU($cu->id, $likeCounter);
        ?>
        <div id="content" class="col-12 col-lg-9">
            <section id="mainArea" class="col-12 col-lg-9">
                <div>
                    <?php echo $__env->make('partials.publish_card', ['where'=>$cu->abbrev], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <input id="cu_id" type="hidden" value="<?php echo e($cu->id); ?>" readonly>
                <div id="data"></div>
            </section>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/simawatt/Documents/FEUP/lbaw2013/resources/views/pages/cupage.blade.php ENDPATH**/ ?>