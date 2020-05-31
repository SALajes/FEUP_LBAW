<link rel="stylesheet" href="{{ asset('css/search_card.css') }}">

<?php function draw_results($results)
{ ?>
    <?php 
        draw_student_card_search();
        draw_professor_card_search();
        draw_cu_card_search();
    ?>
<?php } ?>

<?php function draw_student_card_search()
{ ?>
    <div id="student_card" class="card bg-light mb-3" style="width: 16rem; height: 16rem;">
        <div class="card-header">Student</div>
        <div class="card-body">
                @if (FALSE)
                    <div id="profile_picture" class="img-circle d-flex justify-content-between align-items-center">
                        <img src="/storage/profile_image/{{ Auth::user()->profile_image }}" class="img-profile"/>
                    </div>
                @else
                    <i id="profile_picture" class="icon-user profile-button d-flex justify-content-center"></i>
                @endif
            <h5 class="card-title">Sofia Lajes</h5>
            <p class="card-text">up201704066</p>
        </div>
    </div>
<?php } ?>

<?php function draw_professor_card_search()
{ ?>
    <div id="professor_card" class="card bg-light mb-3" style="width: 16rem; height: 16rem;">
        <div class="card-header">Professor</div>
        <div class="card-body">
                @if (FALSE)
                    <div id="profile_picture" class="img-circle d-flex justify-content-between align-items-center">
                        <img src="/storage/profile_image/{{ Auth::user()->profile_image }}" class="img-profile"/>
                    </div>
                @else
                    <i id="profile_picture" class="icon-user profile-button d-flex justify-content-center"></i>
                @endif
            <h5 class="card-title">Tiago Boldt</h5>
        </div>
    </div>
<?php } ?>

<?php function draw_cu_card_search()
{ ?>
    <div id="cu_card" class="card bg-light mb-3" style="width: 16rem; height: 16rem;">
        <div class="card-header">Curricular Unit</div>
        <div class="card-body">
            <h5 class="text-center">LBAW</h5>
            <p class="card-title">Laboratório de Bases de Dados e Aplicações Web</p>
        </div>
    </div>
<?php } ?>
