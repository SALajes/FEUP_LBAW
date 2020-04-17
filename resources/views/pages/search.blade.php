<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<?php
include_once('../templates/header.php');

include_once('../templates/navbar.php');


include_once('../templates/card.php');

include_once('../templates/sidebar.php');
?>

<script src="../scripts/cu_sidebar.js" defer></script>
<body id="cupage" class="container-fuild ">
    

        <div class="row">
            <?php
            draw_sidebar_Top("Search", "Alvaro Campos", "up188800613");
            draw_sidebar_Search();
            ?>
            <main id="posts" class="col-lg-6 col-md-12">

                <div id="content" class="col-12 offset-lg-0">

                    <!-- VAI DAR Reflected XSS aqui, preparar isto dps-->

                    <div>
                    <h4>Showing results for: "BDAD"</h4>
                    </div>

                    <?php include('../templates/card_teacher.php'); ?>
                    <?php include('../templates/card_cu.php'); ?>
                </div>
            </main>
        <div>

        <div class="col-3">
        </div>

</body>
<?php
include_once('../templates/footer.php');
?>