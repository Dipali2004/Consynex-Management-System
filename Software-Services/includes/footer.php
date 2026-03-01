<!--footer start-->
<footer class="footer" data-bg-img="images/bg/02.png">
  <div class="container">
    <div class="primary-footer">
      <div class="row">

        <!-- ✅ Left Side -->
        <div class="col-lg-5 col-md-12">
          <h5>Get In Touch</h5>
          <ul class="media-icon list-unstyled mb-8">
            <li>
              <p class="mb-0">
                <?php echo COMPANY_ADDRESS; ?>
              </p>
            </li>
            <li>
              <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a>
            </li>
            <li>
              <a href="tel:+91<?php echo COMPANY_PHONE; ?>"><?php echo COMPANY_PHONE_DISPLAY; ?></a>
            </li>
          </ul>

          <h5>Follow Us</h5>
          <ul class="list-inline ps-0 ms-0 footer-social">
            <li class="list-inline-item">
              <a href="https://www.facebook.com/profile.php?id=61587784525507" target="_blank">
                <i class="bi bi-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.instagram.com/consynex_technologies?igsh=ZnM0Y25kOHc5bGp4" target="_blank">
                <i class="bi bi-instagram"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://twitter.com/" target="_blank">
                <i class="bi bi-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.linkedin.com/company/consynex-tech/" target="_blank">
                <i class="bi bi-linkedin"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://youtube.com/" target="_blank">
                <i class="bi bi-youtube"></i>
              </a>
            </li>
          </ul>
        </div>

        <!-- ✅ Right Side -->
        <div class="col-lg-7 col-md-12 mt-6 mt-lg-0">
          <h5>Information</h5>

          <div class="row">
            <!-- ✅ Company Links -->
            <div class="col-lg-4 col-md-4 mt-5 mt-md-0 footer-menu">
              <h6 class="text-white mb-3">Company</h6>
              <ul class="list-unstyled w-100">
                <li><a href="index.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="team.php">Our Team</a></li>
                <li><a href="#">Careers</a></li>
              </ul>
            </div>

            <!-- ✅ Services Links -->
            <div class="col-lg-4 col-md-4 mt-5 mt-md-0 footer-menu">
              <h6 class="text-white mb-3">Services</h6>
              <ul class="list-unstyled w-100">
                <li><a href="services.php">Web Development</a></li>
                <li><a href="services.php">Mobile App Development</a></li>
                <li><a href="services.php">UI/UX Design</a></li>
                <li><a href="services.php">Digital Marketing</a></li>
              </ul>
            </div>

            <!-- ✅ Support Links -->
            <div class="col-lg-4 col-md-4 mt-5 mt-md-0 footer-menu">
              <h6 class="text-white mb-3">Support</h6>
              <ul class="list-unstyled">
                <li><a href="contact.php">Contact</a></li>
                <li><a href="contact.php">Support</a></li>
                <li><a href="privacy-policy.php">Privacy Policy</a></li>
                <li><a href="terms-and-conditions.php">Terms & Conditions</a></li>
              </ul>
            </div>
          </div>

          <!-- ✅ Newsletter -->
          <div class="row mt-8">
            <div class="col-md-10">
              <h5>Subscribe Our Newsletter</h5>
              <div class="subscribe-form">
                <form id="mc-form" class="mc-form">
                  <input type="email" value="" name="EMAIL" class="email" id="mc-email"
                         placeholder="Email Address" required="">
                  <input class="subscribe-btn" type="submit" name="subscribe" value="Subscribe Now">
                </form>
                <small class="d-block mt-3">
                  Get latest updates, offers & tech news from Consynex Technologies.
                </small>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- ✅ Copyright -->
  <div class="secondary-footer">
    <div class="container">
      <div class="copyright">
        <div class="row text-center">
          <div class="col">
            © <?php echo date("Y"); ?> | All Rights Reserved by Consynex Technologies
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--footer end-->

</div>
<!-- page wrapper end -->


<!--back-to-top start-->

<div class="scroll-top">
  <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
  </svg>
</div>

<!--back-to-top end-->

<!-- WhatsApp Floating Button -->
<?php if (defined('ADMIN_MOBILE') && defined('WHATSAPP_API_URL')): ?>
<a href="#" class="float-whatsapp" onclick="openWhatsApp(); return false;">
    <i class="bi bi-whatsapp"></i>
</a>
<script>
function openWhatsApp() {
    const mobile = '<?php echo ADMIN_MOBILE; ?>';
    const message = encodeURIComponent('Hello, I have a query.');
    const url = '<?php echo WHATSAPP_API_URL; ?>' + mobile + '?text=' + message;
    window.open(url, '_blank');
}
</script>
<?php endif; ?>

 
<!-- inject js start -->

<!--== jquery -->
<script src="js/jquery.min.js"></script> 

<!--== bootstrap -->
<script src="js/bootstrap.bundle.min.js"></script>

<!--== jquery-appear -->
<script src="js/jquery-appear.js"></script> 

<!--== owl-carousel -->
<script src="js/owl.carousel.min.js"></script> 

<!--== magnific-popup --> 
<script src="js/jquery.magnific-popup.min.js"></script>

<!--== counter -->
<script src="js/odometer.min.js"></script>

<!--== countdown -->
<script src="js/jquery.countdown.min.js"></script> 

<!--== wow -->
<script src="js/wow.min.js"></script>

<!--== color-customize -->
<script src="js/color-customize/color-customizer.js"></script> 

<!--== theme-script -->
<script src="js/theme-script.js"></script>

<!-- inject js end -->
</body>
</html>