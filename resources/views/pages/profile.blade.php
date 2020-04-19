<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')

@section('title', 'My Profile')

@section('content')


<section role="main">

    <div class="container-fuild">
        <div class="row">
            <?php
                $bc = "Profile";
                if ($owner)$bc = "My " . $bc;
                draw_sidebar_Top($bc, $student->name, $student->student_number);
                draw_sidebar_Profile($student->bio, 999, $owner);
            ?>
            
            <main id="content" class="col-lg-9">
                <div id="nav">
                    <div id="tabs" class="nav nav-tabs nav-fill">
                        <a class="nav-item nav-link active" href="profile1.php" role="button" aria-pressed="true">My CUs</a>
                        <a class="nav-item nav-link" href="profile2.php" role="button" >My Ratings</a>
                        <a class="nav-item nav-link" href="#" role="button">Manage CUs</a>
                    </div>
                </div>

                    <?php //draw_myCUs(); ?>
                
            </main>
        </div>
    </div>
</section>
@endsection