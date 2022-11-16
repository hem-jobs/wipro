<div class="content-wrapper">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Depposit funds</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="./user/deposit" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label for="amount">Amount to Deposit <i class="fas fa-dollar-sign"></i></label>
                    <input type="number" name="amount" id="amount" required min="10" step="10">
                </div>
                <div class="form-group">
                    <label for="method">Deposit Method</label>
                    <select name="method" id="method">
                        <option value="BTC">BTC</option>
                        <option value="ETH">ETH</option>
                        <option value="USDT">USDT</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?= $User->id ?>">
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>
</div>