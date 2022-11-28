<?php
@$User = $Core->GetUserInfo($Template->storage('accid'));
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?= domain ?>">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <!-- This is an example of how to link site assets 👇 to the page -->
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

  <!-- Smartsupp Live Chat script -->
  <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '43f41cb876f9b5703563baa893e219cfb3f80943';
    window.smartsupp || (function(d) {
      var s, c, o = smartsupp = function() {
        o._.push(arguments)
      };
      o._ = [];
      s = d.getElementsByTagName('script')[0];
      c = d.createElement('script');
      c.type = 'text/javascript';
      c.charset = 'utf-8';
      c.async = true;
      c.src = 'https://www.smartsuppchat.com/loader.js?';
      s.parentNode.insertBefore(c, s);
    })(document);
  </script>





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
    <!-- header-section start  -->
    <header class="header">
      <div class="header__bottom">
        <div class="container">
          <nav class="navbar navbar-expand-xl p-0 align-items-center">
            <a class="site-logo site-title" href="./">
              <img src="<?= $assets ?>/images/logo.webp" alt="site-logo"></a>
            <ul class="account-menu mobile-acc-menu">
              <?php if (!isset($User->name)) : ?>
                <li class="icon">
                  <!-- This is an 👇 example route on the frontend -->
                  <a href="./login"><i class="las la-user"></i></a>
                </li>
              <?php endif; ?>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="menu-toggle"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav main-menu m-auto">
                <li> <a href="./">Home</a></li>
                <li> <a href="./about">About Us</a></li>
                <li> <a href="./plan">Plan</a></li>
                <li><a href="./dashboard">Dashboard</a></li>
                <li><a href="./contact">Contact</a></li>
                <li>
                  <!-- GTranslate: https://gtranslate.io/ -->
                  <div id="google_translate_element2"></div>
                  <script type="text/javascript">
                    function googleTranslateElementInit2() {
                      new google.translate.TranslateElement({
                        pageLanguage: 'en',
                        autoDisplay: false
                      }, 'google_translate_element2');
                    }
                  </script>
                  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


                  <script type="text/javascript">
                    /* <![CDATA[ */
                    eval(function(p, a, c, k, e, r) {
                      e = function(c) {
                        return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
                      };
                      if (!''.replace(/^/, String)) {
                        while (c--) r[e(c)] = k[c] || e(c);
                        k = [function(e) {
                          return r[e]
                        }];
                        e = function() {
                          return '\\w+'
                        };
                        c = 1
                      };
                      while (c--)
                        if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
                      return p
                    }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
                    /* ]]> */
                  </script>

                </li>
              </ul>
              <?php if (!isset($User->name)) : ?>
                <div class="nav-right">
                  <ul class="account-menu ml-3">
                    <li class="icon">
                      <a href="./login"><i class="las la-user"></i></a>
                    </li>
                  </ul>

                </div>
              <?php endif; ?>
            </div>
          </nav>
        </div>
      </div><!-- header__bottom end -->
    </header>
    <!-- header-section end  -->