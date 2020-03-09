<?php
include_once('../templates/header.php');

include_once('../templates/navbar.php');


include_once('../templates/card.php');

include_once('../templates/sidebar.php');
?>
<div class="container-fuild">
    <main id="posts" class="col-6">

        <div class="row page-header navbar navbar-expand-lg navbar-light bg-light">
            <div class="col-sm-9">
                <h1 class="d-block text-center" style="margin-top:5rem; margin-left:5rem; padding-bottom: 1rem">BDAD</h1>
            </div>
            <div class="col-sm-3">
            <button type="button" id="sidebarCollapse" class="btn btn-info d-lg-none " style="margin-top:3.5rem; padding-bottom: 1rem">
                <i class="fas fa-align-left"></i>
            </button>
            </div>
        </div>
        <div class="row">
            <?php
            draw_sidebar_cu();
            ?>
            <div class="col-lg-9 col-md-12">

                <?php include_once('../templates/publish_card.php'); ?>

                <?php
                draw_card1();
                draw_card2();
                draw_card1();
                draw_card2( );
                ?>
            </div>
            <div>
    </main>

</div>
<script src="../scripts/sidebar_collapse.js"></script>
<?php
include_once('../templates/footer.php');
?>