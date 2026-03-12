<?php include_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="Consynex Technologies provides Web Development, Java Training, C and C++ Programming Training, CCTV Installation, AMC Maintenance, LAN/Wi-Fi Setup, Router Configuration, Antivirus Security Setup, Computer & Laptop Support, Data Backup and Software Installation services.">

<meta name="keywords" content="Consynex Technologies, Web Development Company, Java Training Institute, C Programming Training, C++ Training, CCTV Installation Services, AMC Maintenance Services, LAN WiFi Setup, Router Configuration, IT Infrastructure Support, Computer Laptop Support, Software Installation Services, Data Backup and Recovery">

<title>Consynex Technologies | Web Development, Java Training & IT Services</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- favicon icon -->
<link rel="shortcut icon" href="images/consynex_icon.ico" />

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

<!--== card-update -->
<link href="css/card-update.css" rel="stylesheet" type="text/css" />

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
    <nav class="navbar navbar-expand-lg w-100">
      <div class="container-fluid px-lg-5 px-3">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php">
          <div class="logo-wrapper">
             <img src="images/companyLogo.png" alt="CONSYNEX TECHNOLOGIES" class="img-fluid">
          </div>
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler ht-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <svg width="100" height="100" viewBox="0 0 100 100">
            <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"></path>
            <path class="line line2" d="M 20,50 H 80"></path>
            <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"></path>
          </svg>
        </button>

        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse flex-grow-1 justify-content-center" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="courses.php">Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Placements</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>

<!--header end-->
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