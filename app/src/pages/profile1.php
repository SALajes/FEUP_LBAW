<?php
	include_once('../templates/header.php');
    include_once('../templates/navbar.php');
    include_once('../templates/sidebar.php');
    include_once('../templates/tpl_profile.php');

?>

<body role="main">
    <link rel="stylesheet" href="../styles/profile.css">

    <div class="container-fuild">
        <div class="row">
            <?php 
                draw_sidebar_Top("My Profile", "Alvaro Campos", "up188800613"); 
                draw_sidebar_Profile();
            ?>
            
            <main class="col-lg-9">
                <div class="container" style="margin-top: 10rem">
                    <nav>
                        <div id="tabs" class="nav nav-tabs nav-fill" role="tablist">
                            <a class="nav-item nav-link active" href="profile1.php">My CUs</a>
                            <a class="nav-item nav-link" href="profile2.php">My Ratings</a>
                            <a class="nav-item nav-link" href="#">Manage CUs</a>
                        </div>
                    </nav>

                    <?php draw_myCUs(); ?>
                
                </div>
            </main>
        </div>
    </div>
</body>

<?php
	include_once('../templates/footer.php');
?>