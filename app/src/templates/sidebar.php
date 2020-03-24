<link rel="stylesheet" href="../styles/sidebar.css">

<?php function draw_sidebar_Top($breadcrumb, $username, $usrId) { ?>
    <aside class="col-lg-3 sticky-top align-self-start" id="page-title">
        <section class="row-md-auto">
            <div class="text-center">
                <h2 class="d-block pt-md-4"><?= $breadcrumb ?></h2>
                <a class="nav-item nav-link d-none d-sm-block d-md-block" href="profile1.php"><i id="profile_picture" class="icon-user" style="font-size: 7rem;"></i></a>
                <p class="d-none d-sm-block d-md-block"><?= $username ?></p>
                <p class="d-none d-sm-block d-md-block"><?= $usrId ?></p>
            </div>
        </section>
        <hr id="student_identification">
<?php } ?>

<?php function draw_sidebar_Homepage() { ?>
        <section id="MyCUs" class="row-md-auto d-none d-md-block d-md-none">
            <h4 class="text-center">My CU's</h4>
            <ul>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="cupage.php"> COMP </a>
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="cupage.php"> IART </a>
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="cupage.php"> LBAW</a>
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="cupage.php"> BDAD </a>
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
        </section>
    </aside>

    <!-- Divisao Vertical -->

<?php } ?>

<?php function draw_sidebar_Profile() { ?>
    <section class="row-md-auto justify-content-center ">
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

<?php function draw_sidebar_CU() { ?>
    <section class="d-lg-block offset-lg-6 offset-xl-1 d-flex justify-content-center flex-wrap">
        <div class="btn-group-vertical btn-group-toggle d-flex flex-wrap justify-content-center" role="group" aria-label="Tabs" id="cu_tabs">
            <div class="row col-xl-12 col-md-4 col-6 justify-content-center">
                <button id="feed_btn" type="button" class="btn btn-link">
                    <h3>Feed</h3>
                </button>
            </div>
            <div class="row col-xl-12 col-md-4 col-6 justify-content-center">
                <button id="drive_btn" type="button" class="btn btn-link">
                    <h3>Drive</h3>
                </button>
            </div>
            <div class="row col-xl-12 col-md-4 col-6 justify-content-center">
                <button id="doubts_btn" type="button" class="btn btn-link">
                    <h3>Doubts</h3>
                </button>
            </div>
            <div class="row col-xl-12 col-md-4 col-6 justify-content-center">
                <button id="tutor_btn" type="button" class="btn btn-link">
                    <h3>Tutoring</h3>
                </button>
            </div>
            <div class="row col-xl-12 col-md-4 col-6 justify-content-center">
                <button id="classes_btn" type="button" class="btn btn-link">
                    <h3>Classes</h3>
                </button>
            </div>
            <div class="row col-xl-12 col-md-4 col-6 justify-content-center">
                <button id="about_btn" type="button" class="btn btn-link">
                    <h3>About</h3>
                </button>
            </div>
        </div>
    </section>

    <!-- Divisao Vertical -->
    </aside>

<?php } ?>

<?php function draw_sidebar_Search() { ?>
    <section class="row-md-auto justify-content-center">

        <div class="row d-flex flex-wrap justify-content-center">

            <div class="row d-inline-flex flex-wrap">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">My CUs</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">All CUs </label>
                </div>
            </div>
        </div>

        <div class="row d-flex flex-wrap justify-content-center">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="profs">
                <label class="form-check-label" for="inlineCheckbox1">Include Professors</label>
            </div>
        </div>

        <div class="row d-flex flex-wrap justify-content-center">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="students">
                <label class="form-check-label" for="inlineCheckbox2">Include Students</label>
            </div>
        </div>

        <div class="row d-flex flex-wrap justify-content-center">
            <div class="col-12 text-center">
                <label for="customRange2" class=" text-center">Curricular year</label>
            </div>
            <div class="col-lg-10 col-6">
                <input type="range" class="custom-range" min="1" max="5" id="customRange2">
            </div>
        </div>

    </section>

    <!-- Divisao Vertical -->
    </aside>
<?php } ?>