<link rel="stylesheet" href="<?php echo e(asset('css/sidebar.css')); ?>">

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
						<a class="nav-item nav-link d-none d-sm-block d-md-block" href="/professors/<?php echo e($professor->id); ?>">
							<?php if($professor->profile_image): ?>
							<div class="img-circle d-flex justify-content-between align-items-center">
								<img src="/storage/profile_image/<?php echo e($professor->profile_image); ?>" class="img-profile" />
							</div>
							<?php else: ?>
							<i id="profile_picture" class="icon-user profile-button"></i>
							<?php endif; ?>
						</a>
					</div>

					<p class="d-none d-sm-block d-md-block"><?= $professor->name ?></p>
					<p class="d-none d-sm-block d-md-block"><?= $professor->email ?></p>
				</div>
			</section>
			<hr id="student_identification">
<?php } ?>

<?php function draw_sidebar_Top($breadcrumb, $userNo,  $username, $studentNo) { ?>
			<aside class="col-lg-3 sticky-top align-self-start" id="page-title">
				<section class="row-md-auto">
					<div class="text-center">
						<h2 class="d-block pt-md-4"><?= $breadcrumb ?> </h2>
						<div class="d-flex justify-content-center align-items-center">
							<a class="nav-item nav-link d-none d-sm-block d-md-block" href="/users/<?php echo e($userNo); ?>">
								<?php if(auth()->user()->profile_image): ?>
								<div class="img-circle d-flex justify-content-between align-items-center">
									<img src="/storage/profile_image/<?php echo e(Auth::user()->profile_image); ?>" class="img-profile" />
								</div>
								<?php else: ?>
								<i id="profile_picture" class="icon-user profile-button"></i>
								<?php endif; ?>
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

<?php function draw_sidebar_Profile($bio, $likeCounter, $owner) { ?>
			<section class="row-md-auto justify-content-center ">
				<blockquote class="text-center col-md-10 mx-auto">
					<?php
					if ($bio != null) echo $bio;
					else echo "<p style=\"font-style: italic\">This user has not uploaded a bio, yet...</p>";
					?>
				</blockquote>
				<?php
				if (Auth::user()->administrator) { ?>
					<div class="d-flex justify-content-around">
						<a href="<?php echo e(url('/manageCreateRequests/')); ?>" class="btn btn-default">
							<button id="manage_create_requests_button" class="btn btn-primary" type="button">
								Manage create CU requests
							</button>
						</a>
					</div>
					<div class="d-flex justify-content-around">
						<a href="<?php echo e(url('/manageJoinRequests/')); ?>" class="btn btn-default">
							<button id="manage_join_requests_button" class="btn btn-primary" type="button">
								Manage join CU requests
							</button>
						</a>
					</div>
				<?php } ?>
				
				<?php if($owner) { ?>
					<div class="d-flex justify-content-around">
						<button id="editProfileButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit</button>
					</div>
				<?php } ?>
				
				<div class="d-flex justify-content-around likes_friend">
					<div>
						<a data-toggle="modal" data-target="#rateStudentModal" class="btn btn-default">
							<i class="icon-like" style="color: #0aedb3"></i> <?= $likeCounter ?>
						</a>
					</div>
					<?php
					if (!$owner) { ?>
						<div>
							<i class="icon-add_friend" style="color: #0aedb3"></i>
						</div>
					<?php
					} ?>
				</div>
			</section>
		</aside>
<?php } ?>

<?php function draw_sidebar_CU($id, $likeCounter, $enrolled) { ?>
		<section class="d-lg-block offset-lg-6 offset-xl-1 d-flex justify-content-center flex-wrap">
			<div class="d-flex justify-content-around likes_friend">
				<a data-toggle="modal" data-target="#rateCUModal" class="btn btn-default">
					<i class="icon-like" style="color: #0aedb3"></i> <?= $likeCounter ?>
				</a>
			</div>
			<?php if($enrolled) { ?>
				<div class="d-flex justify-content-around">
					<form action="<?php echo e(url('/askJoinCU/' . $id)); ?>" method="post">
						<?php echo e(csrf_field()); ?>

						<button id="manage_join_requests_button" class="btn btn-primary" type="submit">
							Join
						</button>
					</form>
				</div>
			<?php } ?>
			
			<div class="btn-group-vertical btn-group-toggle d-flex flex-wrap justify-content-center" role="group" aria-label="Tabs" id="cu_tabs">
				<?php if(Auth::user()->administrator) { ?>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit</button>
				<?php }?>
				
				<div class="row col-xl-12 col-md-4 col-6 justify-content-center">
					<button id="feed_btn" type="button" class="btn btn-link">
						Feed
					</button>
				</div>
				<div class="row col-xl-12 col-md-4 col-6 justify-content-center">
					<button id="doubts_btn" type="button" class="btn btn-link">
						Doubts
					</button>
				</div>
				<div class="row col-xl-12 col-md-4 col-6 justify-content-center">
					<button id="tutor_btn" type="button" class="btn btn-link">
						Tutoring
					</button>
				</div>
				<div class="row col-xl-12 col-md-4 col-6 justify-content-center">
					<button id="classes_btn" type="button" class="btn btn-link">
						Classes
					</button>
				</div>
				<div class="row col-xl-12 col-md-4 col-6 justify-content-center">
					<button id="about_btn" type="button" class="btn btn-link">
						About
					</button>
				</div>
			</div>
		</section>
		<!-- Divisao Vertical -->
	</aside>
	<script src=<?php echo e(asset('js/editCU.js')); ?> defer></script>
	<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit curricular unit</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="edit-cu-name-form" class="form-horizontal" method="POST" action="/cu/<?= $id ?>/editName" enctype="multipart/form-data">
						<?php echo e(csrf_field()); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">New name:</label>
							<div class="col-md-6">
								<input name="cu_name" type="text" id="cu_name" form="edit-cu-name-form" />
								<div id="name_error"></div>
							</div>
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</form>
					<form id="edit-cu-abbrev-form" class="form-horizontal" method="POST" action="/cu/<?= $id ?>/editAbbrev" enctype="multipart/form-data">
						<?php echo e(csrf_field()); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">New abbreviation:</label>
							<div class="col-md-6">
								<input name="cu_abbrev" type="text" id="cu_abbrev" form="edit-cu-abbrev-form" />
								<div id="abbrev_error"></div>
							</div>
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</form>
					<form id="edit-cu-description-form" class="form-horizontal" method="POST" action="/cu/<?= $id ?>/editDescription" enctype="multipart/form-data">
						<?php echo e(csrf_field()); ?>

						<div class="form-group">
							<label class="col-md-4 control-label">New description:</label>
							<div class="col-md-6">
								<input name="cu_description" type="text" id="cu_description" form="edit-cu-description-form" />
								<div id="description_error"></div>
							</div>
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

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
<?php } ?><?php /**PATH /home/pcp/Desktop/FEUP/LBAW/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>