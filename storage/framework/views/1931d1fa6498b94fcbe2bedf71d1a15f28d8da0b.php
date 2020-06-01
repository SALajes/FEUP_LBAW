 
<?php $__env->startSection('title', 'Landing'); ?> 
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/landing.css')); ?>"/>

<body>
    <header class="background-gradient-blue">
        <section class="masthead mb-auto pt-3 d-flex pr-5 justify-content-end">
            <div class="inner">
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active text-white" href="<?php echo e(url('/')); ?>">Home</a>
                    <a class="nav-link text-white" href="<?php echo e(url('/about')); ?>">About</a>
                </nav>
            </div>
        </section>
        <section class="position-relative overflow-hidden p-3 p-md-3 text-center text-white">
            <div class="col-md-3 p-lg-3 mx-auto my-3">
                <h1 class="font-weight-normal">About us</h1>
            </div>
        </section>
    </header>
    <main class="container marketing mt-5">
        <section class="row featurette">
            <blockquote>
                <h2 class="featurette-heading">
                    We are just like you.
                    <span class="text-info">University students.</span>
                </h2>
                <p class="lead">
                    Four friends at FEUP came together to design a tool that lets you and your pals 
                    discover and create. We have dreams, like you. 
                </p>
            </blockquote>
        </section>
        <section class="row featurette">
            <blockquote>
                <h2 class="featurette-heading">
                    <span class="text-info">FEUP.</span>
                    LBAW.
                </h2>
                <p class="lead">
                    This project was developed in the context of the Laboratory of Databases and 
                    Web Applications (LBAW) at the Faculty of Engineering of the University of Porto (FEUP).
                </p>
            </blockquote>
        </section>
    </main>
    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-3">
            <img class="rounded-circle" src="<?php echo e(asset('images/cadu.jpg')); ?>" alt="Generic placeholder image" width="140" height="140">
            <h2>Carlos Duarte</h2>
            <p>Descrição pipi</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-3">
            <img class="rounded-circle" src="<?php echo e(asset('images/pedro.jpg')); ?>" alt="Generic placeholder image" width="140" height="140">
            <h2>Maria do Carmo</h2>
            <p>Descrição pipi</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-3">
            <img class="rounded-circle" src="<?php echo e(asset('images/simão.jpg')); ?>" alt="Generic placeholder image" width="140" height="140">
            <h2>Simão Oliveira</h2>
            <p>Descrição pipi</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-3">
            <img class="rounded-circle" src="<?php echo e(asset('images/sofia.jpeg')); ?>" alt="Generic placeholder image" width="140" height="140">
            <h2>Sofia Lajes</h2>
            <p>Descrição pipi</p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div>
</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/simawatt/Documents/FEUP/lbaw2013/resources/views/pages/about.blade.php ENDPATH**/ ?>