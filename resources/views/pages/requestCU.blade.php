<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')

@section('title', 'Request CU')

@section('content')



<div class="container-fuild">
    <div class="row">
       <?php
            $bc = "Request CU";
            draw_sidebar_Top($bc, Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
        ?>
		<section id="MyCUs" >
            <h4 class="text-center">My CU's</h4>
                <ul>
                    @each('partials.cu_list', $cus, 'cu')
                </ul>
        </section>
        </aside>
        <!-- offset-lg-0 offset-md-2 offset-3 -->
        <div id="content" class="col-12 col-lg-9">
            <div id="nav">
                <div id="tabs" class="nav nav-tabs nav-fill">
                    <a class="nav-item nav-link" href="#" role="button" aria-pressed="true">My CUs</a>
                    <a class="nav-item nav-link" href="#" role="button" >My Ratings</a>
                </div>
            </div>

            <input id="student_id" type="hidden" value="{{ Auth::user() -> id }}" readonly>
            <div id="data"></div>

        </div>
    </div>
</div>

@endsection