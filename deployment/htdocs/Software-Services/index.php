
<?php
// Initialize dynamic banner system
require_once __DIR__ . '/../training/app/Config.php';
require_once __DIR__ . '/../training/app/Database.php';
require_once __DIR__ . '/../training/app/EnvLoader.php';
require_once __DIR__ . '/../training/app/Models/Banner.php';
require_once __DIR__ . '/../training/app/Models/Course.php';
use TrainingApp\App\Models\Banner;
use TrainingApp\App\Models\Course;
use TrainingApp\App\EnvLoader;

// Load environment variables
EnvLoader::load(__DIR__ . '/../.env');

$heroImage = 'images/banner/01.jpg'; // Default fallback
try {
    $banners = Banner::allActive();
    if (!empty($banners)) {
        // Use the first active banner
        $heroImage = $banners[0]['image_path'];
    }
} catch (Exception $e) {
    // Keep default if DB fails
}

// Fetch featured courses (or all active if no featured logic)
$courses = [];
try {
    $courses = Course::featured(3); // Try to get featured first
    if (empty($courses)) {
        // Fallback to latest 3 active courses if no featured ones
        $allCourses = Course::allActive();
        $courses = array_slice($allCourses, 0, 3);
    }
} catch (Exception $e) {
    // Handle error silently
}

include("includes/header.php");
?>
<section class="hero-consynex d-flex align-items-center">
  <div class="overlay"></div>
  <div class="container position-relative">
    <div class="row">
      <div class="col-lg-10 col-xl-8">
        <h1 class="display-4 fw-bold text-white mb-3 animate__animated animate__fadeInUp">CONSYNEX TECHNOLOGIES</h1>
        <h2 class="h4 text-white-50 mb-4 animate__animated animate__fadeInUp animate__delay-1s">Industry-Oriented IT Training & Career Development Institute</h2>
        <p class="text-white-50 mb-4 animate__animated animate__fadeInUp animate__delay-2s">At Consynex Technologies, we provide practical, job-focused IT training with real-time projects, expert mentors, and industry-relevant courses. Our goal is to prepare students for successful careers in the IT industry.</p>
        <div class="d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-3s">
          <a class="themeht-btn cta-primary" href="/training/courses">Explore Courses</a>
          <a class="themeht-btn dark-btn cta-secondary" href="/training/contact">Contact Us</a>
        </div>
        <div class="mt-4 d-flex gap-3 text-white-50 animate__animated animate__fadeInUp animate__delay-4s">
          <i class="bi bi-code-slash"></i>
          <i class="bi bi-laptop"></i>
          <i class="bi bi-patch-check"></i>
        </div>
      </div>
    </div>
  </div>
  <style>
    .hero-consynex{position:relative;min-height:92vh;background:url('<?php echo htmlspecialchars($heroImage); ?>') center/cover no-repeat;font-family:'Poppins',Inter,Roboto,system-ui,-apple-system,Segoe UI,Arial,sans-serif}
    .hero-consynex .overlay{position:absolute;inset:0;background:linear-gradient(180deg,rgba(6,10,15,.75),rgba(6,10,15,.55))}
    .hero-consynex .themeht-btn{border-radius:.6rem;transition:transform .15s ease, box-shadow .15s ease}
    .hero-consynex .cta-primary{background:#2563eb;border-color:#2563eb;color:#fff}
    .hero-consynex .cta-secondary{border-color:#93c5fd;color:#fff}
    .hero-consynex .themeht-btn:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,0,0,.18)}
  </style>
</section>


<!--body content start-->

<div class="page-content">

<!--courses start-->
<section>
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <div class="theme-title">
          <h6>Featured Courses</h6>
          <h2>Upgrade Your Skills With Our Top Courses</h2>
          <p>Explore our industry-standard courses designed to boost your career. Learn from experts and work on real-world projects.</p>
        </div>
      </div>
    </div>
    <div class="row gx-lg-5 text-center justify-content-center">
      <?php if (empty($courses)): ?>
        <div class="col-12"><p class="text-muted">No courses available at the moment.</p></div>
      <?php else: ?>
        <?php $hideEnquiryButton = true; ?>
        <?php foreach ($courses as $c): ?>
          <?php include 'includes/course_card.php'; ?>
        <?php endforeach; ?>
        <?php unset($hideEnquiryButton); ?>
      <?php endif; ?>
    </div>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a class="themeht-btn primary-btn" href="/training/courses">
                <span>View All Courses</span><i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
  </div>
</section>
<!--courses end-->


<!--about start-->

<section>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12">
        <img class="img-fluid" src="images/about/03.png" alt="">
      </div>
      <div class="col-lg-6 col-md-12 mt-6 mt-lg-0 ps-lg-10">
        <div class="theme-title mb-4">
          <h6>About Us</h6>
          <h2>We're Best In Software Development</h2>
        </div>
        <p class="mb-5">Scale your software operations through a custom engineering team. Meet the demand of your company’s operations with a high-performing nearshore team skilled in the technologies you need.</p>
        <a class="themeht-btn" href="#">See About Us</a>
      </div>
    </div>
  </div>
</section>

<!--about end-->


<!--feature start-->

<section class="service-sec position-relative">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="theme-title z-index-1">
          <h6>Features</h6>
          <h2>We Provide Exciting Feature</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="featured-item style-1">
          <div class="featured-icon">
            <img class="img-fluid" src="images/feature/01.png" alt="">
          </div>
          <div class="featured-title">
            <h5>Digital Design</h5>
          </div>
          <div class="featured-desc">
            <p>See your authentic mission, and values come to life with a unique brand image.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mt-6 mt-md-0">
        <div class="featured-item style-1">
          <div class="featured-icon">
            <img class="img-fluid" src="images/feature/02.png" alt="">
          </div>
          <div class="featured-title">
            <h5>New Brands</h5>
          </div>
          <div class="featured-desc">
            <p>See your authentic mission, and values come to life with a unique brand image.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mt-6 mt-lg-0">
        <div class="featured-item style-1">
          <div class="featured-icon">
            <img class="img-fluid" src="images/feature/03.png" alt="">
          </div>
          <div class="featured-title">
            <h5>User Experience</h5>
          </div>
          <div class="featured-desc">
            <p>See your authentic mission, and values come to life with a unique brand image.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mt-6 mt-lg-0">
        <div class="featured-item style-1">
          <div class="featured-icon">
            <img class="img-fluid" src="images/feature/04.png" alt="">
          </div>
          <div class="featured-title">
            <h5>Helping Support</h5>
          </div>
          <div class="featured-desc">
            <p>See your authentic mission, and values come to life with a unique brand image.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--feature end-->


<!--about start-->

<section class="mt-10">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12 order-lg-1">
        <div class="about-img-box">
          <img class="img-fluid" src="images/about/01.jpg" alt="">
        </div>
      </div>
      <div class="col-lg-6 col-md-12 mt-6 mt-lg-0 pe-lg-10">
        <div class="theme-title mb-4">
          <h6>What We Do</h6>
          <h2>Online Reporting To Get Best Of Business</h2>
          <p>Scale your software operations through a custom engineering team. Meet the demand of your company’s operations with a high-performing nearshore team skilled in the technologies you need.</p>
        </div>
        <ul class="list-unstyled list-icon">
          <li>
            <i class="bi bi-check-lg"></i> Web development tehnology
          </li>
          <li>
            <i class="bi bi-check-lg"></i> 10 Years of experience
          </li>
          <li>
            <i class="bi bi-check-lg"></i> Top skilled engineers from everywhere
          </li>
          <li>
            <i class="bi bi-check-lg"></i> Best Features that Keep Us Ahed
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!--about end-->


<!--marquee start-->

<section class="overflow-hidden p-0">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col">
        <div class="marquee-wrap">
          <div class="marquee-text">
            <span>A Smart Software Application</span>
            <i class="bi bi-dot"></i>
            <span>Sass Landing Page</span>
            <i class="bi bi-dot"></i>
            <span>Build Software For Business</span>
            <i class="bi bi-dot"></i>
            <span>Startup Business</span>
            <i class="bi bi-dot"></i>
            <span>Creative Design</span>
            <i class="bi bi-dot"></i>
            <span>Software & Sass Landing Page</span>
            <i class="bi bi-dot"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--marquee end-->


<!--portfolio start-->

<!-- <section>
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <div class="theme-title">
          <h6>Portfolio</h6>
          <h2>Let's Check Some Awesome Work From Soften</h2>
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
</section> -->

<!--portfolio end-->


<!--pricing start-->

<section class="light-bg" data-bg-img="images/bg/02.png">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="theme-title z-index-1">
          <h6>Pricing Plan</h6>
          <h2>Choose Affordable Prices</h2>
        </div>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-lg-4 col-md-12">
        <div class="price-table">
          <div class="price-header">
            <div>
              <h3 class="price-title">Basic</h3>
              <div class="price-value">
                <h2>
                  <sup>$</sup>34
                </h2>
                <span>/Month</span>
              </div>
            </div>
            <div class="price-icon">
              <img class="img-fluid" src="images/price-icon/01.png" alt="">
            </div>
          </div>
          <p>Our plans come with a 100% free 14 day trial. No credit card needed.</p>
          <div class="price-list">
            <ul class="list-unstyled">
              <li>
                <i class="bi bi-check-lg"></i>50 Gb Bandwidth
              </li>
              <li>
                <i class="bi bi-check-lg"></i>Unlimited Site licenses
              </li>
              <li>
                <i class="bi bi-check-lg"></i>10 Free Optimization
              </li>
              <li>
                <i class="bi bi-check-lg"></i>24/7 Hours Support
              </li>
            </ul>
          </div>
          <a class="themeht-btn mt-5" href="#">Purchase Now</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 mt-6 mt-lg-0">
        <div class="price-table">
          <div class="price-header">
            <div>
              <h3 class="price-title">Standard</h3>
              <div class="price-value">
                <h2>
                  <sup>$</sup>49
                </h2>
                <span>/Month</span>
              </div>
            </div>
            <div class="price-icon">
              <img class="img-fluid" src="images/price-icon/02.png" alt="">
            </div>
          </div>
          <p>Our plans come with a 100% free 14 day trial. No credit card needed.</p>
          <div class="price-list">
            <ul class="list-unstyled">
              <li>
                <i class="bi bi-check-lg"></i>50 Gb Bandwidth
              </li>
              <li>
                <i class="bi bi-check-lg"></i>Unlimited Site licenses
              </li>
              <li>
                <i class="bi bi-check-lg"></i>10 Free Optimization
              </li>
              <li>
                <i class="bi bi-check-lg"></i>24/7 Hours Support
              </li>
            </ul>
          </div>
          <a class="themeht-btn mt-5" href="#">Purchase Now</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 mt-6 mt-lg-0">
        <div class="price-table">
          <div class="price-header">
            <div>
              <h3 class="price-title">Premium</h3>
              <div class="price-value">
                <h2>
                  <sup>$</sup>59
                </h2>
                <span>/Month</span>
              </div>
            </div>
            <div class="price-icon">
              <img class="img-fluid" src="images/price-icon/03.png" alt="">
            </div>
          </div>
          <p>Our plans come with a 100% free 14 day trial. No credit card needed.</p>
          <div class="price-list">
            <ul class="list-unstyled">
              <li>
                <i class="bi bi-check-lg"></i>50 Gb Bandwidth
              </li>
              <li>
                <i class="bi bi-check-lg"></i>Unlimited Site licenses
              </li>
              <li>
                <i class="bi bi-check-lg"></i>10 Free Optimization
              </li>
              <li>
                <i class="bi bi-check-lg"></i>24/7 Hours Support
              </li>
            </ul>
          </div>
          <a class="themeht-btn mt-5" href="#">Purchase Now</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!--pricing end-->


<!--testimonial start-->

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="theme-title">
          <h6>Student Reviews</h6>
          <h2>What Our Students Say</h2>
        </div>
        <div class="row">
          <div class="col-md-6 mt-md-10">
            <div class="testimonial style-1">
              <div class="testimonial-media">
                <div class="testimonial-img">
                  <img class="img-fluid" src="images/testimonial/dummy-prod-1.jpg" alt="">
                </div>
                <div class="testimonial-quote">
                  <i class="flaticon flaticon-quote"></i>
                </div>
              </div>
              <p>Excellent training with clear explanations and practical examples. The concepts were taught in a very simple way, which helped me gain confidence in IT fundamentals and real-world applications.</p>
              <div class="testimonial-caption">
                <h5>Prathmesh Vaishnav</h5>
                <label>Student</label>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-10 mt-md-0">
            <div class="testimonial style-1">
              <div class="testimonial-media">
                <div class="testimonial-img">
                  <img class="img-fluid" src="images/testimonial/dummy-prod-1.jpg" alt="">
                </div>
                <div class="testimonial-quote">
                  <i class="flaticon flaticon-quote"></i>
                </div>
              </div>
              <p>The teaching quality is very good and industry-oriented. Doubts are cleared patiently, and hands-on practice made learning easy and effective. Highly recommended for beginners.</p>
              <div class="testimonial-caption">
                <h5>Vijay Kamble</h5>
                <label>Student</label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row">
          <div class="col-md-6 mt-10">
            <div class="testimonial style-1">
              <div class="testimonial-media">
                <div class="testimonial-img">
                  <img class="img-fluid" src="images/testimonial/dummy-prod-1.jpg" alt="">
                </div>
                <div class="testimonial-quote">
                  <i class="flaticon flaticon-quote"></i>
                </div>
              </div>
              <p>One of the best learning experiences. The training focuses on both theory and practical knowledge. The guidance and support throughout the course were really helpful.</p>
              <div class="testimonial-caption">
                <h5>Rupesh Gadhve</h5>
                <label>Student</label>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-10 mt-md-0">
            <div class="testimonial style-1">
              <div class="testimonial-media">
                <div class="testimonial-img">
                  <img class="img-fluid" src="images/testimonial/dummy-prod-1.jpg" alt="">
                </div>
                <div class="testimonial-quote">
                  <i class="flaticon flaticon-quote"></i>
                </div>
              </div>
              <p>Very well-structured training with real-time examples. The environment is friendly, and the trainer explains each topic in detail. This course helped me build a strong foundation.</p>
              <div class="testimonial-caption">
                <h5>Aryan Kadam</h5>
                <label>Student</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--testimonial end-->


<!--counter start-->

<section class="p-0 text-center">
  <div class="container">
    <div class="row">
     <div class="col">
      <div class="p-8 white-bg rounded" data-bg-img="images/bg/02.png">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="counter">
              <div class="counter-desc">
                <span class="count-number" data-count="5">5</span>
                <span>+</span>
                <h5>Project Done</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mt-6 mt-sm-0">
            <div class="counter">
              <div class="counter-desc">
                <span class="count-number" data-count="98">98</span>
                <span>%</span>
                <h5>Success Rate</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mt-6 mt-lg-0">
            <div class="counter">
              <div class="counter-desc">
                <span class="count-number" data-count="1">1</span>
                
                <h5>Winning Awards</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mt-6 mt-lg-0">
            <div class="counter">
              <div class="counter-desc">
                <span class="count-number" data-count="10">10</span>
                
                <h5>Happy Client</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
</section>

<!--counter end-->


<!--blog start-->

<section>
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-10 col-md-12">
        <div class="theme-title">
          <h6>Blog & Updates</h6>
          <h2>Our Latest Tech News</h2>
        </div>
      </div>
    </div>

    <div class="row">

      <!-- ✅ Blog 1 -->
      <div class="col-lg-4 col-md-12">
        <div class="post-card">
          <div class="post-image">
            <a href="blog-web-development.php">
              <img class="img-fluid w-100" src="images/blog/01.jpg" alt="Web Development">
            </a>
          </div>

          <div class="post-desc">
            <div class="post-meta">
              <ul class="list-inline">
                <li>
                  <i class="bi bi-calendar3 me-1"></i> 21 Jan, 2026
                </li>
                <li>
                  <i class="bi bi-person me-1"></i> By Software Services Innovation
                </li>
              </ul>
            </div>

            <div class="post-title">
              <h4>
                <a href="blog-web-development.php">Top 7 Web Development Trends in 2026</a>
              </h4>
            </div>
          </div>
        </div>
      </div>

      <!-- ✅ Blog 2 -->
      <div class="col-lg-4 col-md-12 mt-6 mt-lg-0">
        <div class="post-card">
          <div class="post-image">
            <a href="blog-mobile-development.php">
              <img class="img-fluid w-100" src="images/blog/02.jpg" alt="Mobile App Development">
            </a>
          </div>

          <div class="post-desc">
            <div class="post-meta">
              <ul class="list-inline">
                <li>
                  <i class="bi bi-calendar3 me-1"></i> 18 Jan, 2026
                </li>
                <li>
                  <i class="bi bi-person me-1"></i> By Software Services Innovation
                </li>
              </ul>
            </div>

            <div class="post-title">
              <h4>
                <a href="blog-mobile-development.php">Android vs iOS: Which is Better for Your Business?</a>
              </h4>
            </div>
          </div>
        </div>
      </div>

      <!-- ✅ Blog 3 -->
      <div class="col-lg-4 col-md-12 mt-6 mt-lg-0">
        <div class="post-card">
          <div class="post-image">
            <a href="blog-data-analytics.php">
              <img class="img-fluid w-100" src="images/blog/03.jpg" alt="Data Analytics">
            </a>
          </div>

          <div class="post-desc">
            <div class="post-meta">
              <ul class="list-inline">
                <li>
                  <i class="bi bi-calendar3 me-1"></i> 12 Jan, 2026
                </li>
                <li>
                  <i class="bi bi-person me-1"></i> By Software Services Innovation
                </li>
              </ul>
            </div>

            <div class="post-title">
              <h4>
                <a href="blog-data-analytics.php">Data Analytics: How Data is Driving Smart Business Decisions</a>
              </h4>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!--blog end-->

</div>

<!--body content end--> 

<?php
include("includes/footer.php");
?>
