<link rel="stylesheet" href="../styles/homepage.css">

<?php
	include_once('../templates/header.php');

	include_once('../templates/navbar.php');
?>

<div class="container-fluid">
  <div id="homepage" class="row justify-content-md-center">
    <div class="col-3 d-none d-md-block">
        <?php include_once('../templates/homepage_bar.php'); ?>
    </div>
    <div id="posts" class="col-6">
        <h1 class="d-block d-md-none">Home</h1>

        <?php include_once('../templates/publish_card.php'); ?>  

        <?php include('../templates/card.php'); ?>
        <?php include('../templates/card.php'); ?>
        <?php include('../templates/card.php'); ?>      
    </div>
    <div class="col-3">
    </div>
  </div>
</div>



<?php
	include_once('../templates/footer.php');
?>