<?php function draw_sidebar_Top($breadcrumb, $username, $usrId, $tag)
{ ?>
    <link rel="stylesheet" href="../styles/sidebar.css">

    <aside class="col-lg-3 sticky-top sticky-offset align-self-start" id="page-title">
        <section class="row-md-auto">
            <div class="text-center">
                <h2 class="d-block"><?= $breadcrumb ?></h2>
                <a class="nav-item nav-link d-none d-sm-block d-md-block" href="profile1.php"><i id="profile_picture" class="icon-user" style="font-size: 7rem;"></i></a>
                <p class="d-none d-sm-block d-md-block"><?= $username ?></p>
                <p class="d-none d-sm-block d-md-block"><?= $usrId ?></p>
                <p class="d-none d-sm-block d-md-block"><?= $tag ?></p>
            </div>
        </section>

        <hr class="featurette-divider">
    <?php } ?>

    <?php function draw_sidebar_Homepage()
    { ?>
        <section class="row-md-auto d-none d-md-block d-md-none">
            <h4 class="text-center">My CU's</h4>
            <ul>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    COMP
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    IART
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    LBAW
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    PPIN
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
        </section>
    </aside>

    <!-- Divisao Vertical -->

<?php } ?>

<?php function draw_sidebar_Profile()
{ ?>
    <section class="row-md-auto">
        <address class="text-center">Portuguese</address>
        <blockquote class="text-center col-md-10 mx-auto">
            I'm an amazing student, eager to learn, 3rd grade of MIEIC
        </blockquote>
        <div class="d-flex justify-content-around likes_friend">
            <div>
                <i class="icon-like" style="color: #0aedb3"></i> 6
            </div>
            <div>
                <i class="icon-add_friend" style="color: #0aedb3"></i>
            </div>
        </div>
    </section>
    </aside>

    <!-- Divisao Vertical -->
<?php } ?>

<?php function draw_sidebar_cu()
{ ?>

    <section class="row d-md-block">
        <div class="btn-group-vertical btn-group-toggle text-center col-md-3" role="group" aria-label="Tabs" id="cu_tabs">
            <div class="row">
            <button type="button" class="btn btn-link col-md-12"><h3>Feed</h3></button>
            <button type="button" class="btn btn-link col-md-12"><h3>Drive</h3></button>
            <button type="button" class="btn btn-link col-md-12"><h3>Doubts</h3></button>
            </div>
            <div class="row">
            <button type="button" class="btn btn-link col-md-12"><h3>Tuttoring</h3></button>
            <button type="button" class="btn btn-link col-md-12"><h3>Classes</h3></button>
            <button type="button" class="btn btn-link col-md-12"><h3>About</h3></button>
            </div>
        </div>
    </section>

    <!-- Divisao Vertical -->
    </aside>

    <script>
        let btn_grp = document.getElementById("cu_tabs");
        function vert_hor(){
            if(window.innerWidth < 992) btn_grp.className = "btn-group btn-group-toggle text-center";
            else btn_grp.className = "btn-group-vertical btn-group-toggle text-center";
        }
        
        window.addEventListener("resize", vert_hor);
        vert_hor();
    </script>


<?php } ?>