<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= domain ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wipro Register</title>
    <link rel="icon" type="image/png" href="<?= $assets ?>/images/favicon.png" sizes="16x16">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="<?= $assets ?>/css/vendor/bootstrap.min.css">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="<?= $assets ?>/css/all.min.css">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="<?= $assets ?>/css/line-awesome.min.css">
    <link rel="stylesheet" href="<?= $assets ?>/css/vendor/animate.min.css">
    <!-- slick slider css -->
    <link rel="stylesheet" href="<?= $assets ?>/css/vendor/slick.css">
    <link rel="stylesheet" href="<?= $assets ?>/css/vendor/dots.css">
    <!-- dashdoard main css -->
    <link rel="stylesheet" href="<?= $assets ?>/css/main.css">
</head>

<body>
    <div class="preloader">
        <div class="preloader-container">
            <span class="animated-preloader"></span>
        </div>
    </div>

    <!-- scroll-to-top start -->
    <div class="scroll-to-top">
        <span class="scroll-icon">
            <i class="fa fa-rocket" aria-hidden="true"></i>
        </span>
    </div>
    <!-- scroll-to-top end -->

    <div class="full-wh">
        <!-- STAR ANIMATION -->
        <div class="bg-animation">
            <div id='stars'></div>
            <div id='stars2'></div>
            <div id='stars3'></div>
            <div id='stars4'></div>
        </div><!-- / STAR ANIMATION -->
    </div>
    <div class="page-wrapper">

        <!-- account section start -->
        <div class="account-section bg_img" data-background="<?= $assets ?>/images/bg/bg-5.webp">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-7">
                        <div class="account-card">
                            <div class="account-card__header bg_img overlay--one" data-background="<?= $assets ?>/images/bg/bg-6.webp">
                                <h2 class="section-title">Welcome to <span class="base--color">Wipro</span></h2>
                                <p><span class="base--color">Securely</span> create an account</p>
                            </div>
                            <div class="account-card__body">
                                <h3 class="text-center">Create an Account</h2>
                               <p><?=$Self->Toast()?></p>
                                    <form method="post" action="./user/create-account" class="mt-4">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" placeholder="Enter full name" required name="name">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" class="form-control" placeholder="Enter email address" required name="email">
                                        </div>
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input type="text" id="user" class="form-control" placeholder="Enter a username" required name="username">
                                        </div>
                                        <script>
                                            let user = document.getElementById("user");
                                            user.addEventListener("keyup", (e) => {
                                                let input = e.target.value;
                                                let inputSplit = input.split(" ").join("");
                                                e.target.value = inputSplit;
                                            })
                                        </script>
                                        <div class="form-group">
                                            <label>Referal</label>
                                            <input type="text" class="form-control" placeholder="Enter referer id" name="ref_id" value="<?= @$ref_id ?>" <?php if (isset($ref_id)) echo "readonly" ?>>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" placeholder="Enter password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Retype Password</label>
                                            <input type="password" class="form-control" placeholder="Re-enter password" name="repassword" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                                                    <label class="form-check-label" for="exampleCheck1">Remmber me</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 text-sm-right">
                                                <p class="f-size-14">Have an account? <a href="./login" class="base--color">Login</a></p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button class="cmn-btn">SignUp Now</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- account section end -->

    </div> <!-- page-wrapper end -->
    <!-- jQuery library -->
    <script src="<?= $assets ?>/js/vendor/jquery-3.5.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="<?= $assets ?>/js/vendor/bootstrap.bundle.min.js"></script>
    <!-- slick slider js -->
    <script src="<?= $assets ?>/js/vendor/slick.min.js"></script>
    <script src="<?= $assets ?>/js/vendor/wow.min.js"></script>
    <script src="<?= $assets ?>/js/contact.js"></script>
    <!-- dashboard custom js -->
    <script src="<?= $assets ?>/js/app.js"></script>
</body>

</html>