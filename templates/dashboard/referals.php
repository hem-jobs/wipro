<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">

                <?php
                $users = mysqli_query($Core->dbCon, "SELECT * FROM `user` WHERE `ref_id`='$ref_id'");
                if ($users->num_rows) : ?>
                    <?php while ($user = mysqli_fetch_object($users)) : ?>
                        <div class="col-md-3 mt-4">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <?php if (isset($user->photo) && $user->photo != '') : ?>
                                            <img class="profile-user-img img-fluid img-circle" src="_store/<?= $user->photo ?>" alt="user profile picture">
                                        <?php else : ?>
                                            <img class="profile-user-img img-fluid img-circle" src="_store/user.jpg" alt="user profile picture">
                                        <?php endif; ?>
                                    </div>


                                    <h3 class="profile-username text-center"><?= $user->name ?></h3>


                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Balance</b> <a class="float-right">$<?= $user->balance ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Joined</b> <a class="float-right">$<?= $user->created ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Referals</b> <a class="float-right">
                                                <?php
                                                $sql = "SELECT * FROM `user` WHERE `ref_id` = '$user->id'";
                                                $sql = mysqli_query($Core->dbCon, $sql);
                                                $num = $sql->num_rows;
                                                if ($sql->num_rows) {
                                                    echo $sql->num_rows;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    <?php endwhile; ?>
                <?php else : ?>
                    <h1 class="text-center text-info m-3">There's no data</h1>
                <?php endif; ?>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>