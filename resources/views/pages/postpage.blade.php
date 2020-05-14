<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/mainPost.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')

@section('title', 'PostPage')

@section('content')

<div class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">
        <?php
            use Illuminate\Support\Facades\Auth;
            draw_sidebar_Top("Post", Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
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