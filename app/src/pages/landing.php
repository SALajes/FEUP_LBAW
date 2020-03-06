<?php
include_once('../templates/header.php');
?>

<header class="background-gradient-blue">
    <section class="masthead mb-auto pt-3 d-flex pr-5 justify-content-end">
        <div class="inner">
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active text-white" href="#">Home</a>
                <a class="nav-link text-white" href="#">Features</a>
                <a class="nav-link text-white" href="#">Contact</a>
            </nav>
        </div>
    </section>

    <section class="position-relative overflow-hidden p-3 p-md-5 text-center text-white">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 font-weight-normal">LBrAWl</h1>
            <p class="lead font-weight-normal">The most effective communication experience for university students. Chat, share course materials and form groups. All in one platform.</p>
            <a class="btn btn-outline-light" href="#">Sign up</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </section>
</header>

<body>
    <main class="container marketing mt-5">
        <!-- START THE FEATURETTES -->

        <section class="row featurette">
            <blockquote class="col-md-7">
                <h2 class="featurette-heading">Sharing and obtaining course materials. <span class="text-info">Simplified.</span></h2>
                <p class="lead">Each curricular unit has its own drive with course materials uploaded by students. Creating, cooperating
                    and sharing with your peers has never been this easy.
                </p>
            </blockquote>
            <picture class="col-md-5 text-center">
                <i class="fa fa-download text-gradient-blue" style="font-size: 10rem;"></i>
            </picture>
        </section>

        <hr class="featurette-divider">

        <section class="row featurette">
            <blockquote class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Faster and more fluid group formation. <span class="text-info">Without the spam.</span></h2>
                <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
            </blockquote>
            <picture class="col-md-5 text-center">
                <i class="fa fa-users text-gradient-blue" style="font-size: 10rem;"></i>
            </picture>
        </section>

        <hr class="featurette-divider">

        <section class="row featurette">
            <blockquote class="col-md-7">
                <h2 class="featurette-heading">Help and ask for help. <span class="text-info">Anytime, anywhere.</span></h2>
                <p class="lead">No more going through several social media groups in order to get answers to your questions. LBrAWl provides
                    a structured, fast and intuitive interface that allows you to quickly expose your doubts and get help from other
                    peers. Don't forget to also lend a helping hand to your mates!
                </p>
            </blockquote>
            <picture class="col-md-5 text-center">
                <i class="fa fa-hands-helping text-gradient-blue" style="font-size: 10rem;"></i>
            </picture>
        </section>

        <hr class="featurette-divider mt-3">

        <section class="row featurette">
            <blockquote class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Boost self-improvement and encourage your colleagues. <span class="text-info">Rate them anonymously.</span></h2>
                <p class="lead">One of the biggest obstacles students face is identifying their weaknesses. What if fellow students
                    that you have worked with could help you with that? And if you've worked hard enough, they can even upvote your profile.
                </p>
            </blockquote>
            <picture class="col-md-5 text-center">
                <i class="fa fa-angle-double-up text-gradient-blue" style="font-size: 10rem;"></i>
            </picture>
        </section>

        <!-- /END THE FEATURETTES -->

        <hr class="featurette-divider mb-4">
    </main>
</body>

<footer class="col text-center">
    <p>© 2020 LBrAWlers. All Rights Reserved.</p>
</footer>

<?php
include_once('../templates/footer.php');
?>