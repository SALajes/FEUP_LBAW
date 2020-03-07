<?php function draw_leftBar_Top($breadcrumb, $username, $usrId, $tag) { ?>
    <link rel="stylesheet" href="../styles/leftBar.css">
    
    <aside class="col-lg-3 sticky-top sticky-offset align-self-start" id="page-title">
        <section class="row-md-auto">
            <div class="text-center">
                <h2><?= $breadcrumb ?></h2>
                <a class="nav-item nav-link" href="profile.php"><i class="icon-user" style="font-size: 7rem;"></i></a>
                <p><?= $username ?></p>
                <p><?= $usrId ?></p>
                <p><?= $tag ?></p>
            </div>
        </section>

        <hr class="featurette-divider">
<?php } ?>

<?php function draw_leftBar_Homepage() { ?>
        <section class="row-md-auto">
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

<?php function draw_leftBar_Profile() { ?>
        <section class="row-md-auto">
            <address class="text-center">Portuguese</address>
            <blockquote class="text-center col-md-10 mx-auto">
                I'm an amazing student, eager to leran, 3rd grade of MIEIC
            </blockquote>
            <div class="d-flex justify-content-around">
                <div>
                    <i class="far fa-thumbs-up"></i> 6
                </div>    
                <div>
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
        </section>
    </aside>

    <!-- Divisao Vertical -->
<?php } ?>