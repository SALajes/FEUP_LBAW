<?php
include_once('../templates/header.php');

include_once('../templates/navbar.php');


include_once('../templates/card.php');

include_once('../templates/sidebar.php');
?>
<div class="container-fuild">
    <main id="posts">

        <div class="row">
            <?php
            draw_sidebar_Top("BDAD", "Alvaro Campos", "up188800613", "");
            draw_sidebar_cu();
            ?>
            <div class="col-lg-6">

                <?php include_once('../templates/publish_card.php'); ?>

                <?php
                draw_card1();
                draw_card2();
                draw_card1();
                draw_card2();
                ?>
            </div>
        <div>

        <div class="col-3">
        </div>
    </main>

</div>
<?php
include_once('../templates/footer.php');
?>