<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')
@include('partials.search_results')

@section('title', 'Search')

@section('content')

<div class="container-fluid">
    <div class="row">
       <?php
            $bc = "Search";
            $student = Auth::user();
        ?>
        <aside class="col-lg-3 sticky-top align-self-start" id="page-title">
            <section class="row-md-auto">
                <div class="text-center">
                    <h2 class="d-block pt-md-4"><?= 'Search' ?> </h2>                
                </div>
            </section>
        <hr id="student_identification">
        
        <?php
            draw_sidebar_Search();
        ?>
        <div id="content" class="col-12 col-lg-9">
            <aside class="sticky-top align-self-start" id="page-title">
            <section class="row-md-auto">
                <div class="text-center">
                    <h2 id="results_title" class="d-block pt-md-4">Results</h2>
                </div>
            </section>
            <div id="results" class="d-flex flex-row flex-wrap  justify-content-around">
                <?php
                    draw_results($results);
                ?>
            </div>
        </div>
    </div>
</div>

@endsection