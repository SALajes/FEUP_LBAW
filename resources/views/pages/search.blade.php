<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')

@section('title', 'Search')

@section('content')

<div class="container-fluid">
    <div class="row">
       <?php
            $bc = "Search";
            $student = Auth::user();
            draw_sidebar_Top($bc, $student->id, $student->name, $student->student_number);
            draw_sidebar_Search();
        ?>
        <div id="content" class="col-12 col-lg-9">
            <aside class="sticky-top align-self-start" id="page-title">
            <section class="row-md-auto">
                <div class="text-center">
                    <h2 class="d-block pt-md-4">Results</h2> 
                </div>
            </section>
        </div>
    </div>
</div>

@endsection