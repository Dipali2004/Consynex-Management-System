<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

$grouped_courses = [];
try {
    $pdo = Database::conn();
    $stmt = $pdo->query("SELECT * FROM courses WHERE status = '1' ORDER BY category DESC, course_name ASC");
    $courses = $stmt->fetchAll();
    
    foreach ($courses as $c) {
        $grouped_courses[$c['category']][] = $c;
    }
} catch (Exception $e) {
    // Handle error silently
}

include("includes/header.php");
?>

<!--page title start-->
<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1><span>Our</span> Courses</h1>
        <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php"><i class="bi bi-house-door me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Courses</li>
          </ol>
        </nav> -->
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

<!--courses start-->
<section>
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-8 col-md-12">
        <div class="theme-title">
          <h6>Enhance Your Skills</h6>
          <h2>Professional Training Courses</h2>
          <p>Explore our wide range of industry-oriented courses designed to boost your career in IT and Software Development.</p>
        </div>
      </div>
    </div>
    
    <?php if (empty($grouped_courses)): ?>
        <div class="text-center py-5">
            <p class="text-muted">No courses available at the moment. Please check back later.</p>
        </div>
    <?php else: ?>
        <?php foreach ($grouped_courses as $category => $items): ?>
        <div class="mb-5">
            <div class="row" style="margin-bottom: 80px;">
                <div class="col-12 text-center">
                    <h3 class="d-inline-block pb-2 position-relative" style="border-bottom: 3px solid #2563eb; color: #131d2a;">
                        <?php echo !empty($category) ? htmlspecialchars($category) : 'Other Courses'; ?>
                    </h3>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <?php foreach ($items as $c): ?>
                    <?php include 'includes/course_card.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>
<!--courses end-->

<!-- Inquiry Form Section -->
<section id="inquiry-section" class="bg-light position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="theme-title text-center">
                    <h6>Have Questions?</h6>
                    <h2>Inquire About A Course</h2>
                    <p>Fill out the form below to get more details about our courses. Our team will get back to you shortly.</p>
                </div>
                <div class="white-bg box-shadow p-5 rounded">
                    <form id="inquiry-form" onsubmit="submitInquiry(event)">
                        <div id="form-messages"></div>
                        
                        <!-- Hidden Field for Inquiry Type -->
                        <input type="hidden" name="inquiry_type" value="Course">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Your Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" name="mobile" class="form-control" placeholder="Enter mobile number" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Selected Course <span class="text-danger">*</span></label>
                                    <input type="text" id="reference_name" name="reference_name" class="form-control" placeholder="Select a course from above" required readonly style="background-color: #e9ecef;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label>Message / Query</label>
                            <textarea name="message" class="form-control" rows="4" placeholder="How can we help you?"></textarea>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" id="submit-btn" class="themeht-btn primary-btn">
                                <span>Submit Inquiry</span><i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
<!-- page wrapper end -->

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.object-fit-cover {
    object-fit: cover;
}
</style>

<script>
function openInquiryForm(courseName) {
    // Set the course name
    var input = document.getElementById('reference_name');
    if(input) {
        input.value = courseName;
    }
    
    // Scroll to form
    var section = document.getElementById('inquiry-section');
    if(section) {
        section.scrollIntoView({ behavior: 'smooth' });
    }
}

function submitInquiry(event) {
    event.preventDefault();
    
    var form = document.getElementById('inquiry-form');
    var formData = new FormData(form);
    var btn = document.getElementById('submit-btn');
    var msgDiv = document.getElementById('form-messages');
    
    // Disable button
    btn.disabled = true;
    btn.innerHTML = '<span>Sending...</span>';
    
    fetch('ajax_submit_inquiry.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            msgDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
            form.reset();
        } else {
            msgDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        msgDiv.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<span>Submit Inquiry</span><i class="bi bi-arrow-right"></i>';
    });
}
</script>

<?php include("includes/footer.php"); ?>