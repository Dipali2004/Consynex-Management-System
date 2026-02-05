
<?php
include("includes/header.php");
?>

<!--page title start-->

<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1>
          <span>Login</span> Account
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
            <li class="breadcrumb-item active" aria-current="page">Login</li>
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

<!--login start-->

<section>
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-lg-5 col-md-12">
        <img class="img-fluid" src="images/login-img.html" alt="">
      </div>
      <div class="col-lg-5 col-md-12 mt-6 mt-lg-0">
        <div class="login-form white-bg p-5 rounded box-shadow">
          <form id="contact-form" method="post" action="https://themeht.com/template/soften/ltr/php/contact.php">
            <div class="messages"></div>
            <div class="form-group">
              <label>User Name*</label>
              <input id="form_name" type="text" name="name" class="form-control" placeholder="User name" required="required" data-error="Username is required.">
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label>Password*</label>
              <input id="form_password" type="password" name="password" class="form-control" placeholder="Password" required="required" data-error="password is required.">
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group mt-4 mb-5">
              <div class="remember-checkbox d-flex align-items-center justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="check2">
                  <label class="form-check-label" for="check2">Remember me</label>
                </div>
                <a href="#">Forgot Password?</a>
              </div>
            </div>
            <a href="#" class="themeht-btn">Sign in</a>
          </form>
          <span class="mb-0 mt-4 text-capitalize text-black d-inline-block">Don't Have An Account ? <a class="text-decoration-underline" href="register.html">
              <i>Sign Up!</i>
            </a>
          </span>
          <div class="social-icons mt-4 clearfix">
            <ul>
              <li>
                <a href="#">
                  <i class="bi bi-facebook"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="bi bi-twitter"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="bi bi-instagram"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="bi bi-linkedin"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--login end-->

</div>

<!--body content end--> 

<?php
include("includes/footer.php");
?>