<?php include_once __DIR__ . '/config.php'; ?>
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
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php">
          <div class="logo-wrapper">
             <img src="images/companyLogo.png" alt="CONSYNEX TECHNOLOGIES" class="img-fluid">
          </div>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler ht-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <svg width="100" height="100" viewBox="0 0 100 100">
            <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"></path>
            <path class="line line2" d="M 20,50 H 80"></path>
            <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"></path>
          </svg>
        </button>

        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="courses.php">Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Placements</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            
            <!-- Mobile Only Button -->
            <li class="nav-item d-lg-none mt-3">
              <a class="themeht-btn w-100" href="/training/">Enroll Now</a>
            </li>
          </ul>
        </div>

        <!-- Desktop Button (Outside Collapse) -->
        <div class="d-none d-lg-block ms-4">
          <a class="themeht-btn" href="/training/">Enroll Now</a>
        </div>
      </div>
    </nav>
  </div>
</header>

<!--header end-->
<style>
  /* --- Fixed Navbar & Solid Background --- */
  
  /* 1. Body Offset for Fixed Header */
  body {
    padding-top: 120px; /* Match Desktop Header Height */
  }

  /* 2. Header Container - Fixed & Solid */
  #header-wrap {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 120px;
    background-color: #ffffff; /* Solid White */
    box-shadow: 0 4px 20px rgba(0,0,0,0.05); /* Subtle Shadow */
    z-index: 9999;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
  }
  
  /* 3. Navbar Structure */
  .navbar { width: 100%; padding: 0; }
  .navbar > .container { height: 100%; display: flex; align-items: center; }

  /* 4. Logo Styling */
  .navbar-brand {
    height: 100%;
    padding: 0;
    margin-right: 2rem;
    display: flex;
    align-items: center;
  }
  
  /* Wrapper with Fixed Width */
  .logo-wrapper {
    height: 100%;
    width: 280px; /* Fixed Desktop Width */
    display: flex;
    align-items: center;
  }

  .logo-wrapper img {
    height: 100%; 
    width: 100%;
    object-fit: fill; /* Strict fill */
    display: block;
    padding: 0;
    margin: 0;
  }

  /* 5. Menu Items (Dark Text for White Background) */
  .navbar-nav {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin: 0;
    padding: 0;
    height: 100%;
  }

  .navbar .nav-item {
    height: 100%;
    display: flex;
    align-items: center;
  }

  .navbar .nav-link {
    font-family: 'Poppins', sans-serif;
    font-size: 17px;
    font-weight: 600;
    line-height: 1.5;
    color: #0F172A; /* Dark Text */
    padding: 0;
    position: relative;
    transition: color 0.3s ease;
    white-space: nowrap;
    display: inline-block;
  }

  .navbar .nav-link:hover, 
  .navbar .nav-link.active { 
    color: #0EA5E9; 
  }

  /* Underline Effect */
  .navbar .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 0;
    height: 3px;
    background: #0EA5E9;
    transition: width 0.3s ease;
  }
  
  .navbar .nav-link:hover::after, 
  .navbar .nav-link.active::after { 
    width: 100%; 
  }

  /* 6. Buttons */
  .themeht-btn {
    background: #0EA5E9;
    color: #fff;
    border-radius: 6px;
    padding: 0 32px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 50px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .themeht-btn:hover { background: #0284C7; transform: translateY(-1px); color: #fff; }

  /* 7. Responsive / Mobile */
  @media (max-width: 991.98px) {
    body { padding-top: 70px; }
    
    #header-wrap { height: 70px; }
    
    .logo-wrapper { width: 160px; }
    
    /* Mobile Menu */
    .navbar-collapse {
      position: fixed;
      top: 0; right: 0; bottom: 0;
      width: 300px;
      background: #ffffff; /* White background for mobile menu too */
      padding: 90px 25px 30px;
      transform: translateX(100%);
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1030;
      box-shadow: -5px 0 25px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
    }
    .navbar-collapse.show { transform: translateX(0); }
    
    .navbar-nav {
      flex-direction: column;
      align-items: flex-start;
      gap: 0;
      width: 100%;
      height: auto;
    }
    
    .navbar-nav .nav-item { width: 100%; height: auto; display: block; }
    
    .navbar-nav .nav-link { 
      color: #0F172A !important; 
      padding: 14px 0; 
      border-bottom: 1px solid rgba(0,0,0,0.05); 
      font-size: 16px;
      width: 100%;
      display: block;
    }
    
    .navbar-nav .nav-link:hover { color: #0EA5E9 !important; padding-left: 8px; }
    .navbar-nav .nav-link::after { display: none; }
    
    /* Overlay */
    .nav-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); opacity: 0; pointer-events: none; transition: opacity 0.3s; z-index: 1025; }
    .nav-overlay.show { opacity: 1; pointer-events: auto; }
    
    /* Toggler */
    .navbar-toggler { border: none; z-index: 1040; position: relative; padding: 0; margin-left: 15px; }
    .navbar-toggler svg { width: 44px; height: 44px; }
    .navbar-toggler path { stroke: #0F172A; stroke-width: 2; transition: stroke 0.3s; }
    
    .themeht-btn.w-100 { margin-top: 25px; width: 100%; height: 48px; }
  }

  /* Tablet Adjustment */
  @media (min-width: 768px) and (max-width: 991.98px) {
    .logo-wrapper { width: 220px; }
  }

  /* Desktop Logo Fix */
  @media (min-width: 992px) {
    .navbar-collapse { background: transparent; padding: 0; box-shadow: none; }
  }
</style>
<script>
  (function(){
    var c = document.getElementById('navbarNav');
    var overlay = document.createElement('div');
    overlay.className = 'nav-overlay';
    document.body.appendChild(overlay);
    
    // Mobile Menu Overlay Logic
    document.addEventListener('show.bs.collapse', function(e){ if (e.target === c) overlay.classList.add('show'); }, false);
    document.addEventListener('hide.bs.collapse', function(e){ if (e.target === c) overlay.classList.remove('show'); }, false);
    
    // Active Link Logic
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