<link rel="stylesheet" href="<?php echo e(asset('css/homepage.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/search.css')); ?>">



<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.search_results', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', 'Search'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <?php
            $bc = "Search";
            $student = Auth::user();
        ?>
        <aside class="col-lg-3 sticky-top align-self-start" id="page-title">
            <section class="row-md-auto">
                <div class="text-center">
                    <h2 class="d-block pt-md-4"><?= 'Search' ?> </h2>                
                </div>
            </section>
        <hr id="student_identification">
        
        <?php
            $input="";
            if($results != NULL){
                $input=$results[3][0];
            }

            draw_sidebar_Search($input);
        ?>
        <div id="content" class="col-12 col-lg-9">
            <aside class="sticky-top align-self-start" id="page-title">
            <section class="row-md-auto">
                <div id="results_info" class="text-center">
                    <h2 class="d-block pt-md-4">Results</h2>
                </div>
            </section>
            <div id="results" class="d-flex flex-row flex-wrap  justify-content-around">
                <?php
                    if($results != NULL){
                        draw_results($results);
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/meias/Work/GitHub/lbaw2013/resources/views/pages/search.blade.php ENDPATH**/ ?>