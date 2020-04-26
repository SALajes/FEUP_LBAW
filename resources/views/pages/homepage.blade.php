<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">


@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')
@include('partials.publish_card')

@section('title', 'Homepage')

@section('content')

<div class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">
        
        <?php
            use Illuminate\Support\Facades\Auth;
            draw_sidebar_Top("Home", Auth::user() -> id, Auth::user() -> name, Auth::user() -> student_number);
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
                <?php post_form("public"); ?>
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