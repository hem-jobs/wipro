<div class="content-wrapper">
    <div class="row">
        <div class="col-12 card mr-3">
            <div class="card-header border-transparent">
                <h3 class="card-title">Running Investments</h3>
                <br>
                <p></p>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Days</th>
                                <th>Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $inv = "SELECT * FROM `investments` WHERE `status` = 'progress'";
                            $invs = mysqli_query($Core->dbCon, $inv);
                            while ($trans = mysqli_fetch_object($invs)) : ?>
                                <tr>
                                    <td><a href="javascript:void(0)">WIOR0<?= $trans->id ?></a></td>
                                    <td><span class="badge badge-warning">Progress</span></td>
                                    <td>$<?= $trans->amount ?></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $trans->created ?></div>
                                    </td>
                                    <td>
                                        <?= $trans->days ?>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="/finish_investment/<?= $trans->id ?>" class="btn btn-outline-success ">Finish</a>

                                            </div>
                                            <div class="col-6">
                                                <a href="/abort_investment/<?= $trans->id ?>" class="btn btn-outline-danger ">Discard</a>

                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
        </div>
        <br>
        <div class="card col-12">
            <div class="card-header border-transparent">
                <h3 class="card-title">Finished Cycles</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $invested = "SELECT * FROM `investments` WHERE `status` = 'done'";
                            $invested = mysqli_query($Core->dbCon, $invested);

                            while ($trans = mysqli_fetch_object($invested)) : ?>
                                <tr>
                                    <td><a href="javascript:void(0)">WIOR0<?= $trans->id ?></a></td>
                                    <td><span class="badge badge-success">Done</span></td>
                                    <td>$<?= $trans->amount ?></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $trans->end ?></div>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

</div>