<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Wipro</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Wipro Investments</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="text-center ">
        <h5><?= $Self->Toast(); ?></h5>
        <h5>Your Referal Link</h5>
        <p id="ref" style="display:inline;"><?php $username = $User->username;
                                            echo "https://www.wiproinvestment.com/register/{$username}" ?></p>
        <button id="copy" class="btn btn-secondary">Copy</button>

        <script>
          let button = document.querySelector('#copy');
          button.addEventListener("click", () => {
            button.innerHTML = "Copied!";
            let ref = document.getElementById('ref');
            let text = ref.innerHTML;
            setTimeout(() => {
              button.innerHTML = 'Copy'
            }, 2000)
            navigator.clipboard.writeText(text);
          });
        </script>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Balance</span>
              <span class="info-box-number">
                $<?= $User->balance ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="./users/deposit">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Fund Wallet</span>

              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- Investment -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="./plan">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-arrow-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Invest</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- P2P -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="./dashboard/p2p">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-sync"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">P2P</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        <!-- Withdrawal -->
        <div class="col-12 col-sm-6 col-md-3">
          <a href="./dashboard/withdraw">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Withdraw</span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
        <!-- Referals -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Referals</span>
              <span class="info-box-number">

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
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <?php if ($User->role == 'admin') : ?>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="./users/list">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total Users</span>
                  <span class="info-box-number">
                    <?php
                    echo mysqli_query($Core->dbCon, "SELECT * FROM `user`")->num_rows;
                    ?>

                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
        <?php endif; ?>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">

          <div class="row">
            <div class="col-md-12">

            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Transactions</h3>

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
                      <th>Plan</th>
                      <th>Status</th>
                      <th>Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql2 = "SELECT * FROM `transactions` WHERE `user`= '$User->id'";
                    $sql2 = mysqli_query($Core->dbCon, $sql2);

                    while ($trans = mysqli_fetch_object($sql2)) : ?>
                      <tr>
                        <td><a href="javascript:void(0)">WIOR0<?= $trans->id ?></a></td>
                        <td><?= $trans->type ?></td>
                        <?php if ($trans->status == 'pending') : ?>
                          <td><span class="badge badge-warning">Pending</span></td>
                        <?php elseif ($trans->status == 'done') : ?>
                          <td><span class="badge badge-success">Done</span></td>
                        <?php elseif ($trans->status == 'progress') : ?>
                          <td><span class="badge badge-success">Done</span></td>
                        <?php endif; ?>
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

          <!-- Investments -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Investments</h3>

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
                      <th>Plan</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Maturity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql2 = "SELECT * FROM `investments` WHERE `user`= '$User->id'";
                    $sql2 = mysqli_query($Core->dbCon, $sql2);

                    while ($trans = mysqli_fetch_object($sql2)) : ?>
                      <tr>
                        <td><a href="javascript:void(0)">WPINV100<?= $trans->id ?></a></td>
                        <td><?= $trans->package ?></td>

                        <?php
                        $days =  explode("-", $trans->created);

                        if ($trans->status == 'done') : ?>
                          <td><span class="badge badge-success"><?= $days[2] ?></span></td>
                        <?php elseif ($trans->status == 'progress') : ?>
                          <td><span class="badge badge-warning">Running</span></td>
                        <?php endif; ?>
                        <td>
                          <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $trans->created ?></div>
                        </td>
                        <td><?= $trans->days ?> days</td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->


        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->