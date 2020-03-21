<?php
    include_once('../templates/header.php');
    include_once('../templates/navbar.php');
    include_once('../templates/card.php');
    include_once('../templates/sidebar.php');
?>

<link rel="stylesheet" href="../styles/homepage.css">
<script src="../scripts/cu_sidebar.js" defer></script>

<body id="cupage" class="container-fuild ">
            <div class="row">
            <?php
            draw_sidebar_Top("BDAD", "Alvaro Campos", "up188800613", "");
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

<?php
    include_once('../templates/footer.php');
?>