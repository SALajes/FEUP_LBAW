@extends('layouts.app')
@section('title', 'PostPage')
@section('content')

<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/mainPost.css') }}">
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">

@include('partials.navbar')
@include('partials.sidebar')


<div class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">
        <?php

        use Illuminate\Support\Facades\Auth;

        draw_sidebar_Top("Post", Auth::user()->id, Auth::user()->name, Auth::user()->student_number, Auth::user()->profile_image);
        ?>
        <section></section>
        </aside>

        <main id="mainArea" class="col-12 col-lg-6">
            @include('partials.mainPost')

            <section id="comments">
                @foreach($comments as $comment)
                @include('partials.comment')
                @endforeach
            </section>
        </main>

        <section class="col-3">
        </section>
    </div>
</div>

@endsection