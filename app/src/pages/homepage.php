<link rel="stylesheet" href="../styles/homepage.css">

<?php
include_once('../templates/header.php');

include_once('../templates/navbar.php');

include_once('../templates/card.php');

include_once("../templates/sidebar.php");
?>

<body class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">

        <?php
        draw_sidebar_Top("Home", "Alvaro Campos", "up188800613", "");
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

    <?php
    include_once('../templates/footer.php');
    ?>
</body>