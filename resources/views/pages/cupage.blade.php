@extends('layouts.app')
@section('title', 'CU Page')
@section('content')

<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">

@include('partials.navbar')
@include('partials.sidebar')
@include('partials.rate_cu_modal')

<div class="container-fluid">
    <div class="row">
        <?php

        use Illuminate\Support\Facades\Auth;

        draw_sidebar_Top_CU($cu, $teachers);
        draw_sidebar_CU($cu->id, $likeCounter);
        ?>
        <div id="cuArea" class="col-12 col-lg-9">
            <section id="mainArea" class="col-12 col-lg-9">
                <div>
                    @include('partials.publish_card', ['where'=>$cu->abbrev])
                </div>
                <input id="cu_id" type="hidden" value="{{ $cu->id }}">
                <div id="data"></div>
            </section>
        </div>
    </div>
</div>
@endsection