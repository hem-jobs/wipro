<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <h5><?= $Self->Toast() ?></h5>
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php if (isset($User->photo) && $User->photo != '') : ?>
                                    <img class="profile-user-img img-fluid img-circle" src="_store/<?= $User->photo ?>" alt="User profile picture">
                                <?php else : ?>
                                    <img class="profile-user-img img-fluid img-circle" src="_store/user.jpg" alt="User profile picture">
                                <?php endif; ?>
                            </div>
                            <form action="./user/profile/photo" method="post" enctype="multipart/form-data">
                                <input type="file" name="photo" id="photo" class="form-control">
                                <input type="submit" value="Upload" class="btn btn-outline-info btn-block">
                            </form>

                            <h3 class="profile-username text-center"><?= $User->name ?></h3>


                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Balance</b> <a class="float-right">$<?= $User->balance ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Referals</b> <a class="float-right">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                            <?php
                                            $sql = "SELECT * FROM `user` WHERE `ref_id` = '$User->id'";
                                            $sql = mysqli_query($Core->dbCon, $sql);
                                            $num = $sql->num_rows;
                                            if ($sql->num_rows) {
                                                echo $sql->num_rows;
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </button>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">

                                    <div class="card">
                                        <table>
                                            <thead>
                                                <th>ID</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM `transactions` WHERE `user` = '$User->id'";
                                                $query = mysqli_query($Core->dbCon, $query);
                                                while ($que = mysqli_fetch_object($query)) : ?>
                                                    <tr>
                                                        <td>WIO<?=$que->id?></td>
                                                        <td><?=$que->amount?></td>
                                                        <td><?=$que->type?></td>
                                                        <td><?=$que->created?></td>
                                                    
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" action="./user/update_name" method="post">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" id="inputName" value="<?= $User->name ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" class="form-control" readonly value="<?= $User->email ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-outline-info">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form class="form-horizontal" action="./user/update_password" method="post">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" class="form-control" id="password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-outline-secondary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>