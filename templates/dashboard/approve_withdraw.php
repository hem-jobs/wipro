<div class="content-wrapper">
    <div class="row">
        <div class="card mr-3">
            <div class="card-header border-transparent">
                <h3 class="card-title">Withdrawals</h3>
                <br>
                <p>To Approve transfer the amount to the give address and click approve</p>
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
                                <th>Wallet</th>
                                <th>Date</th>
                                <th>Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($trans = mysqli_fetch_object($withdrawals)) : ?>
                                <tr>
                                    <td><a href="javascript:void(0)">WIOR0<?= $trans->id ?></a></td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>$<?= $trans->amount ?></td>
                                    <td>$<?= $trans->address ?></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $trans->created ?></div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="/approve_withdrawal/<?= $trans->id ?>" class="btn btn-outline-success ">Approve</a>

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
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Withdrawals</h3>

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
                            while ($trans = mysqli_fetch_object($withdrawals)) : ?>
                                <tr>
                                    <td><a href="javascript:void(0)">WIOR0<?= $trans->id ?></a></td>
                                    <td><span class="badge badge-warning">Pending</span></td>
                                    <td>$<?= $trans->amount ?></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $trans->created ?></div>
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