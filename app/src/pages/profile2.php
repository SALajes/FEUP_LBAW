<?php
	include_once('../templates/header.php');
    include_once('../templates/navbar.php');
    include_once('../templates/sidebar.php');
    include_once('../templates/tpl_profile.php');

?>
<link rel="stylesheet" href="../styles/profile.css">

<body role="main">
    <div class="container-fuild">
        <div class="row">

            <?php 
                draw_sidebar_Top("My Profile", "Alvaro Campos", "up188800613"); 
                draw_sidebar_Profile();
            ?>
            
            <main id="content" class="col-lg-9">
                <div id="nav">
                    <div id="tabs" class="nav nav-tabs nav-fill">
                        <a class="nav-item nav-link" href="profile1.php" role="button">My CUs</a>
                        <a class="nav-item nav-link active" href="profile2.php" role="button"  aria-pressed="true">My Ratings</a>
                        <a class="nav-item nav-link" href="#" role="button">Manage CUs</a>
                    </div>

                    <?php draw_myRatings(); ?>

                </div>
            </main>
        </div>
    </div>
</body>

<?php
	include_once('../templates/footer.php');
?>