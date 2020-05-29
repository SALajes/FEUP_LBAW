<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<script src={{ asset('js/profile_prof.js') }} defer></script>

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')
@include('partials.edit_professor_modal')
@include('partials.rate_prof_modal')

@section('title', $professor->name)

@section('content')
<div class="container-fluid">
    <div class="row">
       <?php
            $bc = $professor->abbrev . "'s profile";
            draw_sidebar_Top_prof($bc, $professor);
            draw_sidebar_Profile_prof($likeCounter);
        ?>
        <!-- offset-lg-0 offset-md-2 offset-3 -->
        <div id="content" class="col-12 col-lg-9">
            <div id="nav">
                <div id="tabs" class="nav nav-tabs nav-fill">
                    <a class="nav-item nav-link" href="#" role="button" aria-pressed="true">Teaches</a>
                    <a class="nav-item nav-link" href="#" role="button">Ratings</a>
                </div>
            </div>
            <input id="professor_id" type="hidden" value="{{ $professor->id }}" readonly>
            <div id="data"></div>
        </div>
    </div>
</div>
@endsection