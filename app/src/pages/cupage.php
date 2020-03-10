<?php
include_once('../templates/header.php');

include_once('../templates/navbar.php');


include_once('../templates/card.php');

include_once('../templates/sidebar.php');
?>
<!--<script src="../scripts/cu_sidebar.js" defer></script>-->
<body id="cupage" class="container-fuild ">
    

        <div class="row justify-content-md-center">
            <?php
            draw_sidebar_Top("BDAD", "Alvaro Campos", "up188800613", "");
            draw_sidebar_cu();
            ?>
            <main id="posts" class="col-6">

                <div id="content" class="col-12">
                    <?php
                    include_once('../templates/publish_card.php'); 
                    draw_card1();
                    draw_card2();
                    draw_card1();
                    draw_card2();
                    ?>
                </div>
            </main>
        <div>

        <div class="col-3">
        </div>

</body>
<?php
include_once('../templates/footer.php');
?>