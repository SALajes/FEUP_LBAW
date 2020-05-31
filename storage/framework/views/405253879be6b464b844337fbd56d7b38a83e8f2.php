<div class="modal fade" id="rateStudentModal" tabindex="-1" role="dialog" aria-labelledby="rateStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginLabel">Rate student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rate_student_form" class="form-horizontal" method="POST" action="<?php echo e(route('rateStudent', $student)); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Review</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="review" name="review" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/simawatt/Documents/FEUP/lbaw2013/resources/views/partials/rate_student_modal.blade.php ENDPATH**/ ?>