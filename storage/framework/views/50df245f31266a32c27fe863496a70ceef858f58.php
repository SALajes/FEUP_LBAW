<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(route('login')); ?>">
          <?php echo e(csrf_field()); ?>

          <input id="email" type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            <?php if($errors->has('email')): ?>
                <span class="error">
                    <?php echo e($errors->first('email')); ?>

                </span>
            <?php endif; ?>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <?php if($errors->has('password')): ?>
                <span class="error">
                    <?php echo e($errors->first('password')); ?>

                </span>
            <?php endif; ?>
          
            <button class="btn btn-outline-light" type="submit">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div><?php /**PATH /home/meias/Work/GitHub/lbaw2013/resources/views/partials/login.blade.php ENDPATH**/ ?>