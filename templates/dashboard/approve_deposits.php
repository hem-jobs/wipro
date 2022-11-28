<div class="content-wrapper">
    <div class="row">
        <div class="col-12 card mr-3">
            <div class="card-header border-transparent">
                <h3 class="card-title">Pending Deposits</h3>
                <br>
                <p>Before you approve, ensure you have recieved The stated amount from the individual</p>
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
                                <th>Hash</th>
                                <th>Date</th>
                                <th>Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($trans = mysqli_fetch_object($deposits)) : ?>
                                <tr>
                                    <td><a href="javascript:void(0)">WIOR0<?= $trans->id ?></a></td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>$<?= $trans->amount ?></td>
                                    <td>$<?= $trans->hash ?></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $trans->created ?></div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="/approve_deposit/<?= $trans->id ?>" class="btn btn-outline-success ">Approve</a>

                                            </div>
                                            <div class="col-md-6">
                                                <a href="/decline_deposit/<?= $trans->id ?>" class="btn btn-outline-danger ">Decline</a>

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
                <h3 class="card-title">Deposits</h3>

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
                            while ($trans = mysqli_fetch_object($deposits2)) : ?>
                                <tr>
                                    <td><a href="javascript:void(0)">WIOR0<?= $trans->id ?></a></td>
                                    <td><span class="badge badge-success">Done</span></td>
                                    <td>$<?= $trans->amount ?></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $trans->updated ?></div>
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