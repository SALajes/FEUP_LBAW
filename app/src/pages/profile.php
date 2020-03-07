<?php
	include_once('../templates/header.php');

    include_once('../templates/navbar.php');
    
    include_once('../templates/left_bar.php');

?>
<link rel="stylesheet" href="../styles/profile.css">

<body role="main">
    <div class="container-fuild">
        <div class="row">

            <?php 
                draw_leftBar_Top("My Profile", "John Doe", "up00000000", ""); 
                draw_leftBar_Profile();
            ?>
            
            <main class="col-lg-9">
                <div class="container" style="margin-top: 10rem">
                    <div id="butons" class="row d-flex justify-content-around">
                        <!-- butoes -->
                        <a class="btn btn-outline-primary active" href="#" role="button" aria-pressed="true">My CUs</a>
                        <a class="btn btn-outline-primary" href="#" role="button">My Ratings</a>
                        <a class="btn btn-outline-primary" href="#" role="button">Manage CUs</a>
                    </div>
                    <div class="row">
                        <table class="table text-center table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="">COMP</a></td>
                                    <td>Enrolling</td>
                                    <td>Leave</td>
                                </tr>
                                <tr>
                                    <td><a href="">IART</a></td>
                                    <td>Enrolling</td>
                                    <td>Leave</td>
                                </tr>
                                <tr>
                                    <td><a href="">LBAW</a></td>
                                    <td>Enrolling</td>
                                    <td>Leave</td>
                                </tr>
                                <tr>
                                    <td><a href="">PPIN</a></td>
                                    <td>Pending</td>
                                    <td>Cancel</td>
                                </tr>
                                <tr>
                                    <td><a href="">MEST</a></td>
                                    <td>Finished</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

<?php
	include_once('../templates/footer.php');
?>