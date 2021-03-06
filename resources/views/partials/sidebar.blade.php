<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

<?php use Illuminate\Support\Facades\Auth; ?>

<?php function draw_sidebar_Top_CU($cu, $teachers) { ?>
	<aside class="col-lg-3 sticky-top align-self-start" id="page-title">
		<section class="row-md-auto">
			<div class="text-center">
				<h2 class="d-block pt-md-4"><?= $cu->abbrev ?> </h2>
				<hr class="division">

				<?php foreach ($teachers as $teacher) { ?>
					<a href="/professors/<?= $teacher->id ?>">
						<p><?= $teacher->name ?></p>
					</a>
				<?php } ?>
			</div>
			<hr class="division">
		</section>
<?php } ?>

<?php function draw_sidebar_Top_prof($breadcrumb, $professor) { ?>
		<aside class="col-lg-3 sticky-top align-self-start" id="page-title">
			<section class="row-md-auto">
				<div class="text-center">
					<h2 class="d-block pt-md-4"><?= $breadcrumb ?> </h2>
					<div class="d-flex justify-content-center align-items-center">
						<a class="nav-item nav-link d-none d-sm-block d-md-block" href="/professors/{{ $professor->id }}">
							@if ($professor->profile_image)
							<div class="img-circle d-flex justify-content-between align-items-center">
								<img src="/storage/profile_image/{{ $professor->profile_image }}" class="img-profile" />
							</div>
							@else
							<i id="profile_picture" class="icon-user profile-button"></i>
							@endif
						</a>
					</div>

					<p class="d-none d-sm-block d-md-block"><?= $professor->name ?></p>
					<p class="d-none d-sm-block d-md-block"><?= $professor->email ?></p>
				</div>
			</section>
			<hr id="student_identification">
<?php } ?>

<?php function draw_sidebar_Top($breadcrumb, $userNo,  $username, $studentNo, $profile_image) { ?>
			<aside class="col-lg-3 sticky-top align-self-start" id="page-title">
				<section class="row-md-auto">
					<div class="text-center">
						<h2 class="d-block pt-md-4"><?= $breadcrumb ?> </h2>
						<div class="d-flex justify-content-center align-items-center">
							<a class="nav-item nav-link d-none d-sm-block d-md-block" href="/users/{{ $userNo }}">
								<?php if($profile_image != "") { ?>
									<div class="img-circle d-flex justify-content-between align-items-center">
										<img src="/storage/profile_image/<?=$profile_image?>" class="img-profile" />
									</div>
								<?php } else { ?>
									<i id="profile_picture" class="icon-user profile-button"></i>
								<?php } ?>
							</a>
						</div>

						<p class="d-none d-sm-block d-md-block"><?= $username ?></p>
						<p class="d-none d-sm-block d-md-block"><?= $studentNo ?></p>
					</div>
				</section>
				<hr id="student_identification">
<?php } ?>

<?php function draw_sidebar_Profile_prof($likeCounter) { ?>
				<section class="row-md-auto justify-content-center ">
					<?php
					if (Auth::user()->administrator) { ?>
						<div class="d-flex justify-content-around">
							<button id="editProfileButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfModal">Edit</button>
						</div>
					<?php } ?>
					<div class="d-flex justify-content-around likes_friend">
						<div>
							<a data-toggle="modal" data-target="#rateProfModal" class="btn btn-default">
								<i class="icon-like" style="color: #0aedb3"></i> <?= $likeCounter ?>
							</a>
						</div>
					</div>
				</section>
			</aside>
<?php } ?>

<?php function draw_sidebar_Profile($bio, $likeCounter, $owner, $in_profile) { ?>
			<section class="row-md-auto justify-content-center">
				<blockquote class="text-center col-md-10 mx-auto">
					<?php
					if ($bio != null) echo $bio;
					else echo "<p style=\"font-style: italic\">This user has not uploaded a bio, yet...</p>";
					?>
				</blockquote>
				<?php
				if (Auth::user()->administrator && $owner) { ?>
					<div class="d-flex justify-content-around">
						<a href="{{ url('/manageCreateRequests/') }}" class="btn btn-default">
							<button id="manage_create_requests_button" class="btn btn-primary" type="button">
								Manage create CU requests
							</button>
						</a>
					</div>
					<div class="d-flex justify-content-around">
						<a href="{{ url('/manageJoinRequests/') }}" class="btn btn-default">
							<button id="manage_join_requests_button" class="btn btn-primary" type="button">
								Manage join CU requests
							</button>
						</a>
					</div>
				<?php } ?>
				
				<?php if($owner && $in_profile) { ?>
					<div class="d-flex justify-content-around">
						<button id="editProfileButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit</button>
					</div>
				<?php } ?>
				
				<div class="d-flex align-items-center justify-content-center likes_friend">
					<div class="d-flex align-items-center">
						<a data-toggle="modal" data-target="#rateStudentModal" class="btn btn-default"><i class="icon-like" style="color: #0aedb3"></i></a>
						<?= $likeCounter ?>
					</div>
				</div>
			</section>
		</aside>
<?php } ?>

<?php function draw_sidebar_CU($id, $likeCounter, $enrolled) { ?>
		<section class="row-md-auto justify-content-center">
			<div class="d-flex justify-content-center align-items-center likes_friend">
				<a data-toggle="modal" data-target="#rateCUModal" class="btn btn-default">
					<i class="icon-like" style="color: #0aedb3"></i>
				</a>
				<?= $likeCounter ?>
			</div>
			<?php if($enrolled) { ?>
				<div>
					<form action="{{ url('/askJoinCU/' . $id) }}" method="post">
						{{ csrf_field() }}
					<div class="d-flex justify-content-around">
						<button id="manage_join_requests_button" class="btn btn-primary" type="submit">
							Join
						</button>
					</div>
					</form>
				</div>
			<?php } ?>

			<?php if(Auth::user()->administrator) { ?>
				<div class="d-flex justify-content-around">
					<button id="editCUButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCUModal">Edit</button>
				</div>
			<?php }?>
			
			<div id="cu_tabs" class="d-flex flex-column">				
				<div class="d-flex justify-content-around">
					<button id="feed_btn" type="button" class="btn btn-link">
						 Feed 
					</button>
				</div>
				<div class="d-flex justify-content-around">
					<button id="doubts_btn" type="button" class="btn btn-link">
						Doubts
					</button>
				</div>
				<div class="d-flex justify-content-around">
					<button id="tutor_btn" type="button" class="btn btn-link">
						Tutoring
					</button>
				</div>
				<div class="d-flex justify-content-around">
					<button id="classes_btn" type="button" class="btn btn-link">
						Classes
					</button>
				</div>
				<div class="d-flex justify-content-around">
					<button id="about_btn" type="button" class="btn btn-link">
						About
					</button>
				</div>
			</div>
		</section>
		<!-- Divisao Vertical -->
	</aside>
	<script src={{ asset('js/editCU.js') }} defer></script>
	<div class="modal fade" id="editCUModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit curricular unit</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body d-flex flex-column">
					<form id="edit-cu-name-form" class="form-horizontal" method="POST" action="/cu/<?= $id ?>/editName" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="control-label">New name:</label>
							<div>
								<input name="cu_name" type="text" id="cu_name" form="edit-cu-name-form" />
								<div id="name_error"></div>
							</div>
							<div>
								<button type="submit" class="btn btn-primary" style="margin-top:1rem;">Update</button>
							</div>
						</div>
					</form>
					<form id="edit-cu-abbrev-form" class="form-horizontal" method="POST" action="/cu/<?= $id ?>/editAbbrev" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="control-label">New abbreviature:</label>
							<div>
								<input name="cu_abbrev" type="text" id="cu_abbrev" form="edit-cu-abbrev-form" />
								<div id="abbrev_error"></div>
							</div>
							<div>
								<button type="submit" class="btn btn-primary" style="margin-top:1rem;">Update</button>
							</div>
						</div>
					</form>
					<form id="edit-cu-description-form" class="form-horizontal" method="POST" action="/cu/<?= $id ?>/editDescription" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="control-label">New description:</label>
							<div>
								<input name="cu_description" type="text" id="cu_description" form="edit-cu-description-form" />
								<div id="description_error"></div>
							</div>
							<div>
								<button type="submit" class="btn btn-primary" style="margin-top:1rem;">Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php } ?>

<?php function draw_sidebar_Search() { ?>
    <section class="d-flex justify-content-center flex-wrap">
        <form id="search_form">
            <div id="fields" class="btn-group-vertical d-flex flex-wrap justify-content-center" role="group" aria-label="Tabs">
                <label class="form-check-label" for="students">
                    <input name="students" type="checkbox" value="yes" checked>
                    Students
                </label>
                <label class="form-check-label" for="professors">
                    <input name="professors" type="checkbox" value="yes" checked>
                    Professors
                </label>
                <label class="form-check-label" for="curricular_units">
                    <input name="curricular_units" type="checkbox" value="yes" checked>
                    Curricular Units
                </label>
            </div>
        </form>
    </section>
<?php } ?>