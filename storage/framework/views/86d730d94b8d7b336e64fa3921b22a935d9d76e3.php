<link rel="stylesheet" href="<?php echo e(asset('css/navbar.css')); ?>">

<header>
    <input type="hidden" id="studentId" value="<?php echo e(Auth::user() -> id); ?>" readonly>
    <nav id="header" class="navbar fixed-top navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="<?php echo e(url('/homepage')); ?>"><i id="logo" class="icon-logo align-middle"></i></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="true" aria-label="Toggle navigation">
            <i class="icon-menu"></i>
        </button>

        <div id="navbarCollapse" class="collapse navbar-collapse">
            <section id="collapsed_profile" class="d-md-none d-flex flex-row justify-content-center align-items-center flex-wrap">
                <a class="nav-link" href="/users/<?= Auth::user()->id ?>"><i class="icon-user align-middle"></i></a>
                <section class="d-flex flex-column">
                    <span><?php echo e(Auth::user() -> name); ?></span>
                    <span><?php echo e(Auth::user() -> student_number); ?></span>
                </section>
            </section>

            <form id="search" class="form-inline my-2 my-lg-0" action="<?php echo e(route('submitSearch')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input id="query" name="query" class="form-control mr-sm-2" type="search" placeholder="Search">
                <button type="submit" class="btn btn-light"><i class="icon-search"></i></button>
            </form>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="notifications" href="#"><i class="icon-bell align-middle"></i></a>
                    <span class="d-md-none"> Notifications</span>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link" href="/users/<?= Auth::user()->id ?>"><i class="icon-user align-middle"></i></a>
                    <span class="d-md-none"> Profile</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about"><i class="icon-question align-middle"></i></a>
                    <span class="d-md-none"> Help</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/request/cu"><i class="icon-more align-middle"></i></a>
                    <span class="d-md-none"> Requests</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/logout')); ?>"><i class="icon-log-out align-middle"></i></a>
                    <span class="d-md-none"> Logout</span>
                </li>
            </ul>
        </div>
    </nav>
    <div id="not_wrapper">
        <div id="notification_area" class="d-none"></div>
    </div>
</header>
<div id="feedback_msg_area" class="fixed-top">
    <?php if(\Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo \Session::get('success'); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/meias/Work/GitHub/lbaw2013/resources/views/partials/navbar.blade.php ENDPATH**/ ?>