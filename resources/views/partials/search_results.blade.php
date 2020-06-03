<link rel="stylesheet" href="{{ asset('css/search_card.css') }}">

<?php function draw_results($results){
        $stud = $results[0];
        $prof = $results[1];
        $cu = $results[2];

        for($i=0; $i < sizeof($stud); $i++){
            draw_student_card_search($stud[$i]->name, $stud[$i]->student_number, $stud[$i]->profile_image, $stud[$i]->id);
        }

        for($i=0; $i < sizeof($prof); $i++){
            draw_professor_card_search($prof[$i]->name, $prof[$i]->profile_image, $prof[$i]->id);
        }

        for($i=0; $i < sizeof($cu); $i++){
            draw_cu_card_search($cu[$i]->abbrev, $cu[$i]->name, $cu[$i]->id);
        }
} ?>

<?php function draw_student_card_search($name, $number, $path, $id)
{ ?>
    <div id="student_card" class="card bg-light mb-3" style="display: block; width: 16rem; height: 16rem;">
        <div class="card-header">Student</div>
        <a href="/users/{{$id}}">
            <div class="card-body">
                <?php if($path != NULL){ ?>
                    <div id="profile_picture" class="img-circle d-flex justify-content-center">
                        <img src="/storage/profile_image/<?= $path ?>" class="img-profile"/>
                    </div>
                <?php } else { ?>
                    <i id="profile_picture" class="icon-user profile-button d-flex justify-content-center"></i>
                <?php } ?>
                <p class="card-text"><b><?= $name ?></b></p>
                <p class="card-text"><?= $number ?></p>
            </div>
        </a>
    </div>
<?php } ?>

<?php function draw_professor_card_search($name, $path, $id)
{ ?>
    <div id="professor_card" class="card bg-light mb-3" style="display: block; width: 16rem; height: 16rem;">
        <div class="card-header">Professor</div>
        <a href="/professors/{{$id}}">
            <div class="card-body">
                <?php if($path != NULL): ?>
                    <div id="profile_picture" class="img-circle d-flex justify-content-center">
                        <img src="/storage/profile_image/<?= $path ?>" class="img-profile"/>
                    </div>
                <?php else: ?>
                    <i id="profile_picture" class="icon-user profile-button d-flex justify-content-center"></i>
                <?php endif; ?>
                <p class="card-text"><b><?= $name ?></b></p>
            </div>
        </a>
    </div>
<?php } ?>

<?php function draw_cu_card_search($abbrev, $name, $id)
{ ?>
    <div id="cu_card" class="card bg-light mb-3" style="display: block; width: 16rem; height: 16rem;">
        <div class="card-header">Curricular Unit</div>
        <a href="/cu/{{$id}}">
            <div class="card-body">
                <h4 class="text-center"><b><?= $abbrev ?></b></h4>
                <p class="card-text"><?= $name ?></p>
            </div>
        </a>
    </div>
<?php } ?>
