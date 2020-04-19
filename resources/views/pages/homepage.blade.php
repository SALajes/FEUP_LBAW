<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/card.css') }}">


@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')

@section('title', 'Homepage')

@section('content')

<div class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">
        
        <?php
            draw_sidebar_Top("Home");
        ?>

        <section id="MyCUs" >
            <h4 class="text-center">My CU's</h4>
                <ul>
                    @each('partials.cu_list', $cus, 'cu')
                </ul>
        </section>
        </aside>
        <main id="mainArea" class="col-12 col-lg-6">
            <div>
                @include('partials.publish_card')
            </div>

            <!-- <hr id="post-division"> -->

            <section id="posts">
                @each('partials.post', $posts, 'post')
            </section>
        </main>
    
        <section class="col-3">
        </section>
    </div>
</div>

@endsection