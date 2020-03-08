<?php
	include_once('../templates/header.php');
    include_once('../templates/navbar.php');
    include_once('../templates/left_bar.php');
?>

<body>
    <div class="container-fuild">
        <div class="row">

            <?php 
                draw_leftBar_Top("My Profile", "Alvaro Campos", "up188800613", "#mieic"); 
                draw_leftBar_Homepage();
            ?>
            
            <main class="col-lg-9">
                <div class="container">
                    <div class="col-sm-9">
                        
                        <!-- Zona para o user dar post-->
                        <div class="card post-margins">
                            <div class="card-header">
                                To > 
                                <select class="custom-select w-auto">
                                    <option value="1" selected>General</option>
                                    <option value="2">LBAW</option>
                                    <option value="3">PPIN</option>
                                    </select>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" placeholder="What's on your mind?">
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="#"><i class="icon-attach"></i></a>
                                <button id="search" type="button" class="btn btn-light">Post</button>
                            </div>
                        </div> 

                        <hr class="featurette-divider">
                        
                        <!-- Posts de users-->
                        <?php include('../templates/card.php'); ?>
                        <?php include('../templates/card.php'); ?>
                        <?php include('../templates/card.php'); ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

<?php
	include_once('../templates/footer.php');
?>