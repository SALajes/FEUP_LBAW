<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerLabel">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('register')); ?>">
          <?php echo e(csrf_field()); ?>

          <input id="name" type="text" name="name" class="form-control" placeholder="Name" required autofocus>
            <?php if($errors->has('name')): ?>
                <span class="error">
                    <?php echo e($errors->first('name')); ?>

                </span>
            <?php endif; ?>
          <input id="email" type="email" name="email" class="form-control" placeholder="Email" required>
            <?php if($errors->has('email')): ?>
                <span class="error">
                    <?php echo e($errors->first('email')); ?>

                </span>
            <?php endif; ?>
          <input id="student_number" type="text" name="student_number" class="form-control" placeholder="Student number" required>
            <?php if($errors->has('student_number')): ?>
                <span class="error">
                    <?php echo e($errors->first('student_number')); ?>

                </span>
            <?php endif; ?>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <?php if($errors->has('password')): ?>
                <span class="error">
                    <?php echo e($errors->first('password')); ?>

                </span>
            <?php endif; ?>
          <input type="password" class="form-control" id="password_confirm" name="password_confirmation" placeholder="Password" required>

          <button id="pass_submit" class="btn btn-outline-light" type="submit">
            Submit
          </button>
        </form>
      </div>

    </div>
  </div>
</div>
</div><?php /**PATH /home/cadu/Git/lbaw2013/resources/views/partials/register.blade.php ENDPATH**/ ?>