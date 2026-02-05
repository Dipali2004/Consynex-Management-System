<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
<meta name="keywords" content="bootstrap 5, premium, multipurpose, sass, scss, saas, software, startup, technology" />
<meta name="description" content="HTML5 Template" />
<meta name="author" content="www.themeht.com" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Title -->
<title>CONSYNEX TECHNOLOGIES</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<!-- favicon icon -->
<link rel="shortcut icon" href="images/favicon.ico" />

<!-- inject css start -->

<!--== bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!--== bootstrap-icons -->
<link href="css/bootstrap-icons.css" rel="stylesheet" type="text/css" />

<!--== animate -->
<link href="css/animate.css" rel="stylesheet" type="text/css" />

<!--== magnific-popup -->
<link href="css/magnific-popup.css" rel="stylesheet" type="text/css" />

<!--== owl-carousel -->
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" />

<!--== odometer -->
<link href="css/odometer.css" rel="stylesheet" type="text/css" />

<!--== spacing -->
<link href="css/spacing.css" rel="stylesheet" type="text/css" />

<!--== base -->
<link href="css/base.css" rel="stylesheet" type="text/css" />

<!--== shortcodes -->
<link href="css/shortcodes.css" rel="stylesheet" type="text/css" />

<!--== default-theme -->
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--== responsive -->
<link href="css/responsive.css" rel="stylesheet" type="text/css" />

<!--== color-customizer -->
<link href="#" data-style="styles" rel="stylesheet">
<link href="css/color-customize/color-customizer.css" rel="stylesheet" type="text/css" />

<!-- inject css end -->

</head>

<body>

<!-- page wrapper start -->

<div class="page-wrapper">

<!-- preloader start -->

<div id="ht-preloader">
  <div class="loader clear-loader">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <div class="loader-text">Loading</div>
  </div>
</div>

<!-- preloader end -->


<!--header start-->

<header id="site-header" class="header header-transparent">
  <div id="header-wrap">
    <div class="container">
      <div class="row">
        <div class="col">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg">
            <div class="d-flex align-items-center w-100">
              <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <img src="images/Consynex Logo.JPG.jpeg" alt="CONSYNEX TECHNOLOGIES" style="height:36px;width:auto;object-fit:contain">
                <span class="brand-text d-none d-md-inline-flex"><span class="brand-accent">CONSYNEX</span>&nbsp;TECHNOLOGIES</span>
              </a>
              <button class="navbar-toggler ht-toggler ms-auto d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <svg width="100" height="100" viewBox="0 0 100 100">
                  <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"></path>
                  <path class="line line2" d="M 20,50 H 80"></path>
                  <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"></path>
                </svg>
              </button>
              <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="nav navbar-nav gap-lg-3">
                  <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="about-us.php">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/training/courses">Courses</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/training/trainings">Trainings</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="services.php">Services</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Placements</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                  </li>
                  <li class="nav-item d-lg-none mt-3">
                    <a class="themeht-btn w-100" href="/training/">Enroll Now</a>
                  </li>
                </ul>
              </div>
              <a class="themeht-btn ms-lg-3 d-none d-lg-inline-flex" href="/training/">Enroll Now</a>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>

<!--header end-->
<style>
  .header-transparent { position: absolute; left:0; right:0; top:0; background: transparent; }
  .header-scrolled { position: fixed; background: rgba(17,24,39,.8); backdrop-filter: saturate(180%) blur(6px); box-shadow: 0 2px 10px rgba(0,0,0,.12); }
  #header-wrap .container { max-width: 1200px; }
  .navbar { padding-left: 0; padding-right: 0; }
  .navbar-brand { padding: .25rem .5rem; margin-right: .75rem; display: flex; align-items: center; }
  .navbar-brand img { height: clamp(32px, 4.5vw, 56px); width: auto; display: block; object-fit: contain; image-rendering: -webkit-optimize-contrast; transition: transform .2s ease; }
  .navbar-brand:hover img { transform: scale(1.02); }
  .header-transparent .navbar-brand img { filter: drop-shadow(0 1px 2px rgba(0,0,0,.35)); }
  .brand-text { font-weight: 700; font-size: clamp(18px, 2.2vw, 26px); line-height: 1; letter-spacing: .2px; }
  .brand-accent { color:#0EA5E9; }
  .navbar { font-family: 'Poppins', Inter, Roboto, system-ui, -apple-system, Segoe UI, Arial, sans-serif; }
  .navbar .nav-link { font-weight: 500; color: #ffffff; position: relative; padding: .5rem .75rem; }
  .navbar .nav-link:hover { color: #a5b4fc; }
  .navbar .nav-link::after { content:""; position:absolute; left:0; bottom:-6px; width:0; height:2px; background:#38bdf8; transition: width .2s ease; }
  .navbar .nav-link:hover::after { width:100%; }
  .navbar .nav-link.active { color:#ffffff; }
  .navbar .nav-link.active::after { width:100%; }
  .themeht-btn { border-radius: .6rem; background:#0EA5E9; border-color:#0EA5E9; color:#fff; transition: background .3s ease, transform .2s ease, box-shadow .2s ease; }
  .themeht-btn:hover { background:#0284C7; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(2,132,199,.25); }
  /* Desktop non-transparent state: use dark text */
  .header:not(.header-transparent) .navbar .nav-link { color:#0F172A; }
  .header:not(.header-transparent) .navbar .nav-link:hover { color:#0EA5E9; }
  .navbar-toggler { border: none; }
  .navbar-collapse { transition: transform .3s ease, opacity .3s ease; }
  @media (min-width: 992px) {
    .header-transparent .navbar { padding-top: 1rem; padding-bottom: 1rem; }
    .header-scrolled .navbar { padding-top: .85rem; padding-bottom: .85rem; }
    .navbar-brand img { height: 56px; }
    .navbar .navbar-nav { flex-wrap: nowrap; }
    .navbar .navbar-nav .nav-item { white-space: nowrap; }
  }
  @media (max-width: 991.98px) {
    #header-wrap { padding: .25rem 0; }
    .navbar-collapse { position: fixed; right: 0; top: 0; bottom: 0; width: 280px; max-width: 80vw; background: #0F172A; padding: 1rem; transform: translateX(100%); opacity: 0; z-index: 1030; }
    .navbar-collapse.show { transform: translateX(0); opacity: 1; }
    .navbar-nav .nav-link { color: #ffffff; }
    .navbar-nav .nav-link.active, .navbar-nav .nav-link:hover { color:#93C5FD; }
    .nav-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.35); opacity: 0; pointer-events: none; transition: opacity .3s ease; z-index: 1025; }
    .nav-overlay.show { opacity: 1; pointer-events: auto; }
  }
  @media (min-width: 992px) {
    .header-transparent .navbar { padding-top: .75rem; padding-bottom: .75rem; }
  }
</style>
<script>
  (function(){
    var h = document.getElementById('site-header');
    var c = document.getElementById('navbarNav');
    var overlay = document.createElement('div');
    overlay.className = 'nav-overlay';
    document.body.appendChild(overlay);
    function onScroll(){
      var s = window.scrollY || document.documentElement.scrollTop;
      if (s > 40) { h.classList.add('header-scrolled'); h.classList.remove('header-transparent'); }
      else { h.classList.add('header-transparent'); h.classList.remove('header-scrolled'); }
    }
    // If no hero is present, keep solid desktop header
    var hasHero = document.querySelector('.hero-consynex');
    if (!hasHero) { h.classList.add('header-scrolled'); h.classList.remove('header-transparent'); }
    else { onScroll(); }
    window.addEventListener('scroll', onScroll, { passive: true });
    document.addEventListener('show.bs.collapse', function(e){ if (e.target === c) overlay.classList.add('show'); }, false);
    document.addEventListener('hide.bs.collapse', function(e){ if (e.target === c) overlay.classList.remove('show'); }, false);
    var links = document.querySelectorAll('.navbar .nav-link');
    var path = (window.location.pathname || '').toLowerCase();
    links.forEach(function(a){
      var href = (a.getAttribute('href') || '').toLowerCase();
      if (href && path.indexOf(href.replace('./','')) !== -1) { a.classList.add('active'); }
      if ((path.indexOf('/training/courses') !== -1) && a.textContent.trim().toLowerCase()==='courses') a.classList.add('active');
      if ((path.indexOf('/training/trainings') !== -1) && a.textContent.trim().toLowerCase()==='trainings') a.classList.add('active');
    });
  })();
</script>
