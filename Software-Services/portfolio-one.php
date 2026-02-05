
<?php
include("includes/header.php");
?>

<!--page title start-->

<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1>
          <span>Portfolio</span> One
        </h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">
                <i class="bi bi-house-door me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Pages</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Portfolio One</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div class="wave-shape">
    <svg width="100%" height="150px" fill="none">
      <path fill="white">
        <animate repeatCount="indefinite" fill="freeze" attributeName="d" dur="10s" values="
          M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z;
          M0 86.3149C316 86.315 444 159.155 884 51.1554C1324 -56.8446 1320.29 34.1214 1538 70.4063C1814 116.407 2156 188.408 2560 86.315V232.317L0 232.316V86.3149Z;
          M0 53.6584C158 11.0001 213 0 363 0C513 0 855.555 115.001 1154 115.001C1440 115.001 1626 -38.0004 2560 53.6585V199.66L0 199.66V53.6584Z;
          M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z"></animate>
      </path>
    </svg>
  </div>
</section>

<!--page title end-->


<!--body content start-->

<div class="page-content">

<!--portfolio start-->

<section>
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <div class="theme-title">
          <h6>Portfolio</h6>
          <h2 class="title">Let's Check Some Awesome Work From Soften</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="portfolio-item">
          <div class="portfolio-img">
            <img class="img-fluid w-100" src="images/portfolio/01.jpg" alt="">
          </div>
          <div class="portfolio-desc">
            <h4>
              <a href="portfolio-single.html">UI/UX Design</a>
            </h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
        <div class="portfolio-item">
          <div class="portfolio-img">
            <img class="img-fluid w-100" src="images/portfolio/02.jpg" alt="">
          </div>
          <div class="portfolio-desc">
            <h4>
              <a href="portfolio-single.html">Mobile App</a>
            </h4>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-8">
      <div class="col-lg-8 col-md-12 order-lg-1">
        <div class="portfolio-item">
          <div class="portfolio-img">
            <img class="img-fluid w-100" src="images/portfolio/03.jpg" alt="">
          </div>
          <div class="portfolio-desc">
            <h4>
              <a href="portfolio-single.html">Web Design</a>
            </h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
        <div class="portfolio-item">
          <div class="portfolio-img">
            <img class="img-fluid w-100" src="images/portfolio/04.jpg" alt="">
          </div>
          <div class="portfolio-desc">
            <h4>
              <a href="portfolio-single.html">Marketing Design</a>
            </h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--portfolio end-->

</div>

<!--body content end--> 

<?php
include("includes/footer.php");
?>