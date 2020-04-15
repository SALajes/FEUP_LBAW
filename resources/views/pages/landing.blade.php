@extends('layouts.app')

@section('title', 'Landing')

@section('content')

<link rel="stylesheet" href="../styles/landing.css">

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
            <i class="icon-logo" style="font-size: 10rem; color: white;"></i>
            <h1 class="font-weight-normal">LBrAWl</h1>
            <p class="lead font-weight-normal">The most effective communication experience for university students. Chat, share course materials and form groups. All in one platform.</p>
            <a class="btn btn-outline-light" href="homepage.php">Sign up</a>
            <a class="btn btn-outline-light" href="homepage.php">Login</a>
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
                <i class="icon-download text-gradient-blue" style="font-size: 10rem;"></i>
            </picture>
        </section>

        <hr class="featurette-divider">

        <section class="row featurette">
            <blockquote class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Faster and more fluid group formation. <span class="text-info">Without the spam.</span></h2>
                <p class="lead">An easy-to-use tool allows you to handpick who you want to join you in 
                workgroups. Choose students that work the same way you do, and easily check if the students 
                you want to work with aren't yet members of a team. This greatly diminishes spam messages of 
                students asking each other if they want to team up.</p>
            </blockquote>
            <picture class="col-md-5 text-center">
                <i class="icon-teamwork text-gradient-blue" style="font-size: 10rem;"></i>
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
                <i class="icon-partner text-gradient-blue" style="font-size: 10rem;"></i>
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
                <i class="icon-goal text-gradient-blue" style="font-size: 10rem;"></i>
            </picture>
        </section>

        <!-- /END THE FEATURETTES -->

        <hr class="featurette-divider mb-4">
    </main>
</body>

@include('partials.footer')

@endsection