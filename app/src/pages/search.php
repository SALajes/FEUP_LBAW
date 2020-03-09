<link rel="stylesheet" href="../styles/homepage.css">

<?php
include_once('../templates/header.php');

include_once('../templates/navbar.php');
?>

<div class="container-fluid">
  <div id="homepage" class="row justify-content-md-center">
    <div class="col-3 d-none d-md-block">
      <?php include_once('../templates/search_bar.php'); ?>
    </div>
    <div id="posts" class="col-6">
      <h1 class="d-block d-md-none text-center" style="padding-bottom: 1rem">Search</h1>

      <?php include('../templates/card_teacher.php'); ?>
      <?php include('../templates/card_cu.php'); ?>
      <?php include('../templates/card.php'); ?>
    </div>
    <div class="col-3">
    </div>
  </div>
</div>

<?php
include_once('../templates/footer.php');
?>