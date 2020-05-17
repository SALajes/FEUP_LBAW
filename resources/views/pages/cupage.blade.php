<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')
@include('partials.publish_card')
@section('title', 'CU Page')

@section('content')
<div class="container-fuild">
    <div class="row">
        <?php
            use Illuminate\Support\Facades\Auth;
            draw_sidebar_Top($cu->abbrev, Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
            draw_sidebar_CU($cu->id);
        ?>
        <div id="content" class="col-12 col-lg-9">
            <section id="mainArea" class="col-12 col-lg-9">
                <div>
                    <?php post_form($cu->abbrev); ?>
                </div>
                <input id="cu_id" type="hidden" value="{{ $cu->id }}" readonly>
                <div id="data"></div>
            </section>
        </div>
    </div>
</div>
@endsection