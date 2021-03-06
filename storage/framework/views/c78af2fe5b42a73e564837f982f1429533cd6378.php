<link rel="stylesheet" href="<?php echo e(asset('css/homepage.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>">
<script src=<?php echo e(asset('js/requestCU.js')); ?> defer></script>



<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title', 'Request CU'); ?>

<?php $__env->startSection('content'); ?>



<div class="container-fluid">
    <div class="row">
       <?php
            $bc = "Request CU";
            draw_sidebar_Top($bc, Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
        ?>
		<section id="MyCUs" >
            <h4 class="text-center">My CU's</h4>
                <ul>
                    <?php echo $__env->renderEach('partials.cu_list', $cus, 'cu'); ?>
                </ul>
        </section>
        </aside>
		<main id="mainArea" class="col-12 col-lg-6">
			<form action="/request/cu" method="POST">
				<?php echo csrf_field(); ?>
				<input name="student_id" id="student_id" type="hidden" value="<?php echo e(Auth::user() -> id); ?>" readonly>
				<div class="form-group">
					<label for="cu_name">CU name:</label>
    				<input type="text" class="form-control" id="cu_name" name="cu_name" placeholder="Bases de Dados" required>
				</div>

				<div class="form-group">
					<label for="cu_abbrev">CU abbreviation:</label>
    				<input type="text" class="form-control" id="cu_abbrev" name="cu_abbrev" placeholder="BDAD" required>
				</div>

				<div class="form-group">
					<label for="cu_page">Link to page with CU info:</label>
    				<input type="text" class="form-control" id="cu_page" name="cu_page" required>
				</div>

				<div class="form-group">
    				<label for="additional_info">Additional Info</label>
    				<textarea class="form-control" id="additional_info" name="additional_info" rows="3"></textarea>
  				</div>

				  <button type="submit" class="btn btn-primary" formaction="/request/newcu">Submit</button>
			</form>
        </main>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/simawatt/Documents/FEUP/lbaw2013/resources/views/pages/requestCU.blade.php ENDPATH**/ ?>