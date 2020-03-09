<link rel="stylesheet" href="../styles/homepage.css">

<?php
    include_once('../templates/header.php');

    include_once('../templates/navbar.php');

    include_once('../templates/card.php');
?>

<body class="container-fluid">
    <div id="homepage" class="row justify-content-md-center">
        
        <div class="col-3 d-none d-md-block">
            <?php include_once('../templates/homepage_bar.php'); ?>
        </div>

        <main id="posts" class="col-6">
            <h1 class="d-block d-md-none text-center" style="padding-bottom: 1rem">Home</h1>

            <?php include_once('../templates/publish_card.php'); ?>

            <?php
                draw_card1();
                draw_card2();
            ?>

        </main>

        <div class="col-3">
        </div>
    </div>

    <?php
    include_once('../templates/footer.php');
    ?>
</body>