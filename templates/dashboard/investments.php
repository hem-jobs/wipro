<section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header">
                    <h2 class="section-title"><span class="font-weight-normal"></span> <b class="base--color"><?= ucfirst($title) ?> Investment</b></h2>
                    <p>Congrats on choosing the <?= $title ?> plan. Enter a suitable amount within range.</p>
                    <p>Your current balance is $<?= $User->balance ?></p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row justify-content-center mb-none-30">
            <?php if ($package == "Basic") : ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-30">
                    <div class="package-card text-center bg_img" data-background="<?= $assets ?>/images/bg/bg-4.webp">
                        <h4 class="package-card__title base--color mb-2">Basic</h4>
                        <ul class="package-card__features mt-4">
                            <li>Return 3%</li>
                            <li>Every Day</li>
                            <li>For 6 Days</li>
                            <li>Total 18% + <span class="badge base--bg text-dark">Capital</span></li>
                        </ul>
                        <div class="package-card__range mt-5 base--color">$100 - $4999</div>
                        <form action="./invest/<?= "basic" ?>" method="post">
                            <input type="hidden" name="roi" value="18">
                            <input type="hidden" name="days" value="6">
                            <input type="number" class="form-control" name="amount" min="100" max="4999" required>
                            <button type="submit" class="cmn-btn btn-md mt-4">Invest Now</button>
                        </form>
                    </div><!-- package-card end -->
                </div>
            <?php elseif ($package == "Prime") : ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-30">
                    <div class="package-card text-center bg_img" data-background="<?= $assets ?>/images/bg/bg-4.webp">
                        <h4 class="package-card__title base--color mb-2">Prime</h4>
                        <ul class="package-card__features mt-4">
                            <li>Return 4%</li>
                            <li>Every Day</li>
                            <li>For 6 Days</li>
                            <li>Total 24% + <span class="badge base--bg text-dark">Capital</span></li>
                        </ul>
                        <div class="package-card__range mt-5 base--color">$5000 - $49999</div>
                        <form action="./invest/<?= "prime" ?>" method="post">
                            <input type="hidden" name="roi" value="24">
                            <input type="hidden" name="days" value="6">
                            <input type="number" class="form-control" name="amount" min="5000" max="49999" required>
                            <button type="submit" class="cmn-btn btn-md mt-4">Invest Now</button>
                        </form>
                    </div><!-- package-card end -->
                </div>
            <?php elseif ($package == "Vip") : ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-30">
                    <div class="package-card text-center bg_img" data-background="<?= $assets ?>/images/bg/bg-4.webp">
                        <h4 class="package-card__title base--color mb-2">VIP</h4>
                        <ul class="package-card__features mt-4">
                            <li>Return 5.5%</li>
                            <li>Every Day</li>
                            <li>For 5 Days</li>
                            <li>Total 27.5% + <span class="badge base--bg text-dark">Capital</span></li>
                        </ul>
                        <div class="package-card__range mt-5 base--color">$50000 - $500000</div>
                        <form action="./invest/<?= "vip" ?>" method="post">
                            <input type="hidden" name="roi" value="25">
                            <input type="hidden" name="days" value="5">
                            <input type="number" class="form-control" name="amount" min="50000" max="500000" required>
                            <button type="submit" class="cmn-btn btn-md mt-4">Invest Now</button>
                        </form>
                    </div><!-- package-card end -->
                </div>
            <?php elseif ($package == "Promotional") : ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-30">
                    <div class="package-card text-center bg_img" data-background="<?= $assets ?>/images/bg/bg-4.webp">
                        <h4 class="package-card__title base--color mb-2">Promotional</h4>
                        <ul class="package-card__features mt-4">
                            <li>Return 25%</li>
                            <li>Every Day</li>
                            <li>For 2 Days</li>
                            <li>Total 50% + <span class="badge base--bg text-dark">Capital</span></li>
                        </ul>
                        <div class="package-card__range mt-5 base--color">$200001 - $infinity</div>
                        <form action="./invest/<?= "promotional" ?>" method="post">
                            <input type="hidden" name="roi" value="25">
                            <input type="hidden" name="days" value="2">
                            <input type="number" class="form-control" name="amount" min="200001" required>
                            <button type="submit" class="cmn-btn btn-md mt-4">Invest Now</button>
                        </form>
                    </div><!-- package-card end -->
                </div>
            <?php endif; ?>
        </div><!-- row end -->
    </div>
</section>