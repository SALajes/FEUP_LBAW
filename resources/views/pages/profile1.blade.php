@include('partials.navbar')
@include('partials.sidebar')

<?php
    include_once('../templates/tpl_profile.php');
?>

<body role="main">
    <link rel="stylesheet" href="/public/css/profile.css">

    <div class="container-fuild">
        <div class="row">
            <?php 
                draw_sidebar_Top("My Profile", "Alvaro Campos", "up188800613"); 
                draw_sidebar_Profile();
            ?>
            
            <main id="content" class="col-lg-9">
                <div id="nav">
                    <div id="tabs" class="nav nav-tabs nav-fill">
                        <a class="nav-item nav-link active" href="profile1.php" role="button" aria-pressed="true">My CUs</a>
                        <a class="nav-item nav-link" href="profile2.php" role="button" >My Ratings</a>
                        <a class="nav-item nav-link" href="#" role="button">Manage CUs</a>
                    </div>
                </div>

                    <?php draw_myCUs(); ?>
                
            </main>
        </div>
    </div>
</body>

<?php
	@include('partials.footer')
?>