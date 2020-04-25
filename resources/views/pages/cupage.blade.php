<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')
@section('title', 'CU Page')

@section('content')
<div class="container-fuild">
    <div class="row">
        <?php
            use Illuminate\Support\Facades\Auth;
            draw_sidebar_Top($cu->abbrev, Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
            draw_sidebar_CU();
        ?>

    </div>
</div>
@endsection