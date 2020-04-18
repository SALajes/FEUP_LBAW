<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

@extends('layouts.app')

@include('partials.navbar')
@include('partials.sidebar')

@section('content')

<body class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">
        
        <?php
            draw_sidebar_Top("Home", "Alvaro Campos", "up188800613");
            draw_sidebar_Homepage();
        ?>

        <main id="posts" class="col-12 col-lg-6">
            <div id="content">
                @include('partials.publish_card')
            </div>
        </main>
    
        <div class="col-3">
        </div>
    </div>

    @include('partials.footer')
</body>

@endsection