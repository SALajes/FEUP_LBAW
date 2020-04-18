<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')

@section('title', 'Homepage')

@section('content')

<body class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">
        
        <?php
            draw_sidebar_Top("Home");
            draw_sidebar_Homepage();
        ?>

        <main id="newPost" class="col-12 col-lg-6">
            <div id="content">
                @include('partials.publish_card')
            </div>

            <!-- <hr id="post-division"> -->

            <section id="posts">
                @each('partials.post', $posts, 'post')
            </section>
        </main>
    
        <div class="col-3">
        </div>
    </div>
</body>

@endsection