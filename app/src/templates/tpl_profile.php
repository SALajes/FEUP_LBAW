<?php function draw_myCUs() { ?>
    <div class="row">
        <table class="table text-center table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
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
<?php } ?>

<?php function draw_myRatings() { ?>
    <link rel="stylesheet" href="../styles/profile.css">

    <div class="row-md-auto">
        <div class="d-flex justify-content-around" style="margin-top: 2rem">
            <p><i class="far fa-thumbs-up"></i> 6</p>
            <p>3 comments</p>
        </div>

        <hr class="featurette-divider">

        <section class="card d-flex flex-row justify-content-between">
            <i class="icon-user"></i>
            <p class="text-left">Awsome group partner</p>
            <i class="icon-ellipsis"></i>
        </section>

        <section class="card d-flex flex-row justify-content-between">
            <i class="icon-user"></i>
            <p class="text-left">Very kind and considerate, always available and on topic</p>
            <i class="icon-ellipsis"></i>
        </section>

        <section class="card d-flex flex-row justify-content-between align-items-center">
            <i class="icon-user"></i>
            <p clas="text-left">Good Worker!!</p>
            <i class="icon-ellipsis"></i>
        </section>
    </div>
<?php } ?>