<link rel="stylesheet" href="/public/css/homepage.css">

@include('partials.navbar')
@include('partials.card')
@include('partials.sidebar')

<body class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">

        <?php
        draw_sidebar_Top("Home", "Alvaro Campos", "up188800613");
        draw_sidebar_Homepage();
        ?>

        <main id="posts" class="col-12 col-lg-6">
            <div id="content">
                <?php include_once('../templates/publish_card.php'); ?>

                <?php
                draw_card1();
                draw_card2();
                ?>
            </div>
        </main>

        <div class="col-3">
        </div>
    </div>

    @include('partials.footer')
</body>