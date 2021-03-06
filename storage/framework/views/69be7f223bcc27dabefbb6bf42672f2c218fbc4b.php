<script src=<?php echo e(asset('js/editProfile.js')); ?> defer></script>
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="<?php echo e(route('editPassword', Auth::user()->id)); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group<?php echo e($errors->has('current-password') ? ' has-error' : ''); ?>">
                        <label for="current-password" class="col-md-4 control-label">Current password</label>

                        <div class="col-md-6">
                            <input id="current-password" type="password" class="form-control" name="current-password">
                            <div id="cpw_error"></div>
                            <?php if($errors->has('current-password')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('current-password')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group<?php echo e($errors->has('new-password') ? ' has-error' : ''); ?>">
                        <label for="new-password" class="col-md-4 control-label">New password</label>

                        <div class="col-md-6">
                            <input id="new-password" type="password" class="form-control" name="new-password">
                            <div id="npw_error"></div>
                            <?php if($errors->has('new-password')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('new-password')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new-password-confirm" class="col-md-4 control-label">Confirm new password</label>

                        <div class="col-md-6">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation">
                            <div id="npc_error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update password
                            </button>
                        </div>
                    </div>
                </form>

                <form action="<?php echo e(route('editProfilePicture', Auth::user()->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="profile_image" id="profile_image" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                    </div>
                    <div class="col-md-6 col-md-offset-4">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Update profile picture</button>
                        </div>
                    </div>
                </form>

                <form id="bio-form" class="form-horizontal" method="POST" action="<?php echo e(route('editBio', Auth::user()->id)); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="col-md-4 control-label">New bio</label>
                        <div class="col-md-6">
                            <input name="bio" type="text" id="bio" form="bio-form" placeholder="<?php echo e(Auth::user()->bio); ?>" />
                        </div>
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Update bio</button>
                        </div>
                    </div>
                </form>

                <form id="delete-account-form" class="form-horizontal" method="POST" action="<?php echo e(route('deleteAccount')); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Delete account</label>
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-danger">Delete account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/pcp/Desktop/FEUP/LBAW/resources/views/partials/edit_profile_modal.blade.php ENDPATH**/ ?>