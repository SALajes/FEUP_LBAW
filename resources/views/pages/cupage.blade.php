@section('title', 'CurricularUnits')

@section('content')

@include('partials.navbar')
@include('partials.card')
@include('partials.sidebar')

<link rel="stylesheet" href="public/css/homepage.css">
<script src="/public/js/cu_sidebar.js" defer></script>

<body id="cupage" class="container-fuild ">
            <div class="row">
            <?php
            draw_sidebar_Top("BDAD", "Alvaro Campos", "up188800613");
            draw_sidebar_CU();
            ?>
            <main id="posts" class="col-lg-6 col-md-12">

                <div id="content" class="col-12 offset-lg-0">
                </div>
            </main>
        <div>

        <div class="col-3">
        </div>

</body>

@include('partials.footer')

@endsection