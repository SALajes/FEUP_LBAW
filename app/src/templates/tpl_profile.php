<?php function draw_myCUs() { ?>
    <section class="row">
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
                    <td>Enrolled</td>
                    <td>Leave</td>
                </tr>
                <tr>
                    <td><a href="">IART</a></td>
                    <td>Enrolled</td>
                    <td>Leave</td>
                </tr>
                <tr>
                    <td><a href="">LBAW</a></td>
                    <td>Enrolled</td>
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
    </section>
<?php } ?>

<?php function draw_myRatings() { ?>
    <link rel="stylesheet" href="../styles/profile.css">

    <section class="row-md-auto">
        <div id="MyRatings" class="d-flex justify-content-around" style="margin-top: 2rem">
            <p><i class="icon-like" style="color: #0aedb3"></i> 6</p>
            <p>3 comments</p>
        </div>

        <section class="card d-flex flex-row justify-content-between align-items-center">
            <i class="icon-user"></i>
            <div class="card-body">Awesome group partner</div>
            <i class="icon-ellipsis"></i>
        </section>

        <section class="card d-flex flex-row justify-content-between align-items-center">
            <i class="icon-user"></i>
            <div class="card-body">Very kind and considerate, always available and on topic</div>
            <i class="icon-ellipsis"></i>
        </section>

        <section class="card d-flex flex-row justify-content-between align-items-center">
            <i class="icon-user"></i>
            <div class="card-body">Good Worker</div>
            <i class="icon-ellipsis"></i>
        </section>
    </section>
<?php } ?>