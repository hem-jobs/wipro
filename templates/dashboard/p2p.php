<div class="content-wrapper">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">P2P</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="./users/p2p/send" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email or User Id" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Amount</label>
                    <input type="number" min="10" max="<?= $User->balance ?>" name="amount" class="form-control" placeholder="Amount $">
                </div>
                <input type="hidden" name="id" value="<?= $User->id ?>">
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
</div>