<?php

function draw_generic_sidebar()
{
?>

    <div class="col-lg-3 sticky-top sticky-offset align-self-start" id="page-title">

        <div class="row-md-auto">
            <div class="text-center">
                <h2>Home</h2>
                <a class="nav-item nav-link" href="#"><i class="icon-user" style="font-size: 7rem;"></i></a>
                <p>John Doe</p>
                <p>up000000000</p>
                <p>#mieic</p>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row-md-auto">
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

        </div>
    </div>
<?php
}
?>

<?php
function draw_cu_sidebar()
{
?>
    <script src="../scripts/responsive_dropdown.js" defer></script>
    <div class="col-lg-3 sticky-top sticky-offset align-self-start" id="page-title">
        <div class="row-md-auto">
            <div class="text-center">
                <h2>LBAW</h2>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row-md-auto ml-5 pl-5">
            <div class="dropdown">

                <button class="btn btn-secondary dropdown-toggle d-md-none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu show" id="cu_selector">
                    <button type="button" class="btn btn-link dropdown-item">
                        <h3>General</h3>
                    </button>
                    <button type="button" class="btn btn-link dropdown-item">
                        <h3>Drive</h3>
                    </button>
                    <button type="button" class="btn btn-link dropdown-item">
                        <h3>Doubts</h3>
                    </button>
                    <button type="button" class="btn btn-link dropdown-item">
                        <h3>Tuttoring</h3>
                    </button>
                    <button type="button" class="btn btn-link dropdown-item">
                        <h3>Classes</h3>
                    </button>
                    <button type="button" class="btn btn-link dropdown-item">
                        <h3>About</h3>
                    </button>
                </div>
            </div>
        </div>


    </div>
<?php
}
?>