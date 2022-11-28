<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <h1 class="header text-center">
                Payment Page
            </h1>
        </div>
        <div class="card-body">
            <h3 class="text-center">To complete your deposit, You need to do the following:</h3>
            <?php
            $wallet_address = "";
            if ($method == "ETH") {
                $wallet_address = eth;
            } else if ($method == "BTC") {
                $wallet_address = btc;
            } else if ($method == "USDT") {
                $wallet_address = usdt;
            } else {
                return;
            }
            ?>
            <h4 id="ref" style="display: inline;"><?= $wallet_address ?></h4> <button id="copy" class="btn btn-secondary">Copy</button>
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
            <ol class="list">
                <li class="list-item">Copy the <?= $method ?> Wallet Address above</li>
                <li class="list-item">Transfer the $<?= $amount ?> equivalent to the address</li>
                <li class="list-item">Copy the <?= $method ?> transaction hash and paste in the box below</li>
                <li class="list-item">Click the Complete Transaction button and proceed</li>
            </ol>




        </div>
        <div class="card-footer">
            <form action="./user/complete_deposit" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="amount" value="<?= $amount ?>">
                <input type="hidden" name="method" value="<?= $method ?>">
                <label for="hash">Transaction Hash or ID</label>
                <input type="text" name="hash" required class="form-control" minlength="10" placeholder="Enter transaction Hash">
                <button type="submit" class="btn btn-secondary btn-block">Complete Transaction</button>
            </form>
        </div>
    </div>
</div>