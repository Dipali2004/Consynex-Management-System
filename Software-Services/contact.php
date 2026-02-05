
<?php
include("includes/header.php");
?>
<!--page title start-->

<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1>
          <span>Contact</span> Us
        </h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">
                <i class="bi bi-house-door me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Contact</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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

<!--contact start-->

<section class="contact-info pb-0">
  <div class="container">
    <div class="row gx-lg-5 align-items-center">
      <div class="col-lg-4 col-md-12">
        <div class="contact-media"> <i class="flaticon flaticon-office"></i><span>Address:</span>
          <p>5th Street, 21st Floor, New York, USA </p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
        <div class="contact-media"> <i class="flaticon flaticon-email"></i><span>Email Address</span><a href="mailto:themeht23@gmail.com"> themeht23@gmail.com</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
        <div class="contact-media"> <i class="flaticon flaticon-support"></i><span>Phone Number</span><a href="tel:+912345678900">+91-234-567-8900</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <div class="theme-title">
          <h6>Get In Touch</h6>
          <h2>Stay Contact Us</h2>
        </div>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-lg-5 me-auto">
        <img class="img-fluid" src="images/contact-img.png" alt="">
      </div>
      <div class="col-lg-6 mt-7 mt-lg-0">
        <form id="contact-form" method="post" action="https://themeht.com/template/soften/ltr/php/contact.php">
          <div class="messages"></div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name</label>
                <input id="form_name" type="text" name="name" class="form-control" placeholder="Type First name" required="required" data-error="Firstname is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Last Name</label>
                <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Type Last name" required="required" data-error="Lastname is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email Address</label>
                <input id="form_email" type="email" name="email" class="form-control" placeholder="Type Email" required="required" data-error="Valid email is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Phone Number</label>
                <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Type Phone" required="required" data-error="Phone is required">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Message</label>
                <textarea id="form_message" name="message" class="form-control" placeholder="Type Message" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-12 mt-2">
              <button class="themeht-btn">Send Message</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="overflow-hidden p-0">
  <div class="container-fluid p-0">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class="map iframe-h">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.840108181602!2d144.95373631539215!3d-37.8172139797516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1497005461921" allowfullscreen=""></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!--contact end-->

</div>

<!--body content end--> 

<?php
include("includes/footer.php");
?>