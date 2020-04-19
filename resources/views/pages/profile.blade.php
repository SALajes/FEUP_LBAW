<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<script src={{ asset('js/profile.js') }} defer></script>

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
                draw_sidebar_Top($bc, $student->id, $student->name, $student->student_number);
                draw_sidebar_Profile($student->bio, 999, $owner);
            ?>
            
            <!-- offset-lg-0 offset-md-2 offset-3 -->
            <div id="content" class="col-12 col-lg-9">
                <div id="nav">
                    <div id="tabs" class="nav nav-tabs nav-fill">
                        <a class="nav-item nav-link" href="#" role="button" aria-pressed="true">My CUs</a>
                        <a class="nav-item nav-link" href="#" role="button" >My Ratings</a>
                        <a class="nav-item nav-link disabled" href="#" role="button">Manage CUs</a>
                    </div>
                </div>

                <input id="student_id" type="hidden" value="{{ $student->id }}" readonly>
                <div id="data"></div>
                    
                
            </div>
        </div>
    </div>
</section>
@endsection