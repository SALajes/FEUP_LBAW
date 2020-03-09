<?php function draw_sidebar_Top($breadcrumb, $username, $usrId, $tag) { ?>
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

<?php function draw_sidebar_Homepage() { ?>
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

<?php function draw_sidebar_Profile() { ?>
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

<?php function draw_sidebar_cu() { ?>

    <link rel="stylesheet" href="../styles/sidebar.css">
    
    <aside class="col-lg-3 sticky-top align-self-start" id="sidebar_cu">
            <div class="sidebar-header">
                <h3>Bootstrap Sidebar</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Dummy Heading</p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li>
            </ul>
    </aside>


<?php } ?>