<div class="content-wrapper">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Withdrawal</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="./users/withdraw" method="post">
            <div class="card-body">
                <p>Your balance is <?=$User->balance?></p>
                <div class="form-group">
                    <label for="address">Wallet Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Enter wallet Address" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" min="10" max="<?= $User->balance ?>" name="amount" class="form-control" placeholder="Amount $">
                </div>
                <div class="form-group">
                <label for="coin"><i class="fas fa-dollar-sign"></i> Select Token</label>
                <select name="coin" id="coin" class="form-control" required>
             
                    <option value="BTC">BTC <i class="fas fa-btc"></i></option>
                    <option value="ETH">ETH <i class="fab fa-ethereum"></i></option>
                    <option value="USDT">USDT</option>
                </select>
            </div>
                <input type="hidden" name="id" value="<?= $User->id ?>">
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">Place Withrawal Request</button>
            </div>
        </form>
    </div>
</div>