@extends('layouts.app')
@section('title', 'Search')
@section('content')

<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<link rel="stylesheet" href="{{ asset('css/identity.css') }}">

<script src={{ asset('js/search.js') }} defer></script>

@include('partials.navbar')
@include('partials.sidebar')
@include('partials.search_results')

<div class="container-fluid">
    <div class="row">
        <aside class="col-lg-3 sticky-top align-self-start" id="page-title">
            <section class="row-md-auto">
                <div class="text-center">
                    <h2 class="d-block pt-md-4">Search</h2>
                    <div class="d-flex justify-content-center align-items-center">    
                        <?php
                            draw_sidebar_Search();
                        ?>         
                    </div>
                </div>
            </section>

            <div id="content" class="col-12 col-lg-9">
                <aside class="sticky-top align-self-start" id="page-title">
                <section class="row-md-auto">
                    <div id="results_info" class="text-center">
                        <h2 class="d-block pt-md-4">Results</h2>
                    </div>
                </section>
                <div id="results" class="d-flex flex-row flex-wrap  justify-content-around">
                    <?php
                        if($results != NULL){
                            draw_results($results);
                        }
                    ?>
                </div>
            </div>
        </aside>
    </div>
</div>

@endsection