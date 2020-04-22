<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

<?php function draw_sidebar_Top($breadcrumb, $userNo,  $username, $studentNo) { ?>
    <aside class="col-lg-3 sticky-top align-self-start" id="page-title">
        <section class="row-md-auto">
            <div class="text-center">
                <h2 class="d-block pt-md-4"><?= $breadcrumb ?></h2>
                <a class="nav-item nav-link d-none d-sm-block d-md-block" href="/users/{{ $userNo }}"><i id="profile_picture" class="icon-user profile-button"></i></a>
                <p class="d-none d-sm-block d-md-block"><?=$username?></p>
                <p class="d-none d-sm-block d-md-block"><?=$studentNo?></p>
            </div>
        </section>
        <hr id="student_identification">
<?php } ?>

<?php function draw_sidebar_Homepage() { ?>
        <section id="MyCUs" >
            <h4 class="text-center">My CU's</h4>
            <ul>
                <li class="list-group-item d-flex justify-content-around align-items-center">
                    <a href="cupage.php"> COMP </a>
                </li>
                <li class="list-group-item d-flex justify-content-around align-items-center">
                    <a href="cupage.php"> IART </a>
                </li>
                <li class="list-group-item d-flex justify-content-around align-items-center">
                    <a href="cupage.php"> LBAW</a>
                </li>
                <li class="list-group-item d-flex justify-content-around align-items-center">
                    <a href="cupage.php"> BDAD </a>
                </li>
            </ul>
        </section>
    </aside>

    <!-- Divisao Vertical -->

<?php } ?>

<?php function draw_sidebar_Profile($bio, $likeCounter, $owner) { ?>
    <section class="row-md-auto justify-content-center ">
        <blockquote class="text-center col-md-10 mx-auto">
            <?php
            if($bio != null) echo $bio;
            else echo "<p style=\"font-style: italic\">This user has not uploaded a bio, yet...</p>";
            ?>
        </blockquote>
        <div class="d-flex justify-content-around">
            <button id="editProfileButton">Edit</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>
        </div>
        <div class="d-flex justify-content-around likes_friend">
            <div>
                <i class="icon-like" style="color: #0aedb3"></i> <?=$likeCounter?>
            </div>
            <?php
            if (!$owner){?>   
            <div>
                <i class="icon-add_friend" style="color: #0aedb3"></i>
            </div>
            <?php
            }?>
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