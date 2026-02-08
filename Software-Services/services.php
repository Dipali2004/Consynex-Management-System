<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

$services = [];
$grouped_services = [];
try {
    $pdo = Database::conn();
    $stmt = $pdo->query("SELECT * FROM services WHERE status = 1 ORDER BY category DESC, service_name ASC");
    $services = $stmt->fetchAll();
    
    foreach ($services as $s) {
        $grouped_services[$s['category']][] = $s;
    }
} catch (Exception $e) {
    // Handle error silently or log it
}

include("includes/header.php");
?>

<!--page title start-->
<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1><span>Our</span> Services</h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php"><i class="bi bi-house-door me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
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

<!--service start-->
<section>
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-8 col-md-12">
        <div class="theme-title">
          <h6>What We Offer</h6>
          <h2>Professional IT Services</h2>
          <p>We provide comprehensive IT solutions tailored to your business needs, from core computer support to advanced networking infrastructure.</p>
        </div>
      </div>
    </div>
    
    <?php if (empty($grouped_services)): ?>
        <div class="text-center py-5">
            <p class="text-muted">No services available at the moment. Please check back later.</p>
        </div>
    <?php else: ?>
        <?php foreach ($grouped_services as $category => $items): ?>
        <div class="mb-8">
            <div class="row" style="margin-bottom: 80px;">
                <div class="col-12 text-center">
                    <h3 class="d-inline-block pb-2 position-relative" style="border-bottom: 3px solid #2563eb; color: #131d2a;">
                        <?php echo !empty($category) ? htmlspecialchars($category) : 'Other Services'; ?>
                    </h3>
                </div>
            </div>
            <div class="row gx-lg-5 text-center justify-content-center">
                <?php foreach ($items as $srv): ?>
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="service-item style-1 h-100 d-flex flex-column">
                        <div class="service-images mb-4 d-flex align-items-center justify-content-center" style="min-height: 80px;">
                            <?php if (strpos($srv['icon'], 'bi-') !== false || strpos($srv['icon'], 'fa-') !== false): ?>
                                <i class="<?php echo htmlspecialchars($srv['icon']); ?>" style="font-size: 3.5rem; color: #2563eb;"></i>
                            <?php elseif (!empty($srv['icon'])): ?>
                                <img class="img-fluid" src="<?php echo htmlspecialchars($srv['icon']); ?>" alt="" style="max-height: 80px;">
                            <?php else: ?>
                                <i class="bi bi-gear" style="font-size: 3.5rem; color: #2563eb;"></i>
                            <?php endif; ?>
                        </div>
                        <div class="service-desc flex-grow-1 d-flex flex-column">
                            <div class="service-title">
                                <h4><?php echo htmlspecialchars($srv['service_name']); ?></h4>
                            </div>
                            <p class="mb-0"><?php echo htmlspecialchars($srv['description']); ?></p>
                            <div class="mt-3">
                                <button class="btn btn-outline-primary btn-sm rounded-pill px-4" onclick='bookService(<?php echo json_encode($srv['service_name']); ?>)'>
                                    Book Now <i class="bi bi-arrow-right-short"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>
<!--service end-->

<!-- Booking Form Section -->
<section id="booking-section" class="bg-light position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="theme-title text-center">
                    <h6>Book a Service</h6>
                    <h2>Request Service</h2>
                    <p>Fill out the form below to book a service or request a quote. Our team will get back to you shortly.</p>
                </div>
                <div class="white-bg box-shadow p-5 rounded">
                    <form id="inquiry-form" onsubmit="submitInquiry(event)">
                        <div id="form-messages"></div>
                        
                        <!-- Hidden Field for Inquiry Type -->
                        <input type="hidden" name="inquiry_type" value="Service">
                        
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
                                    <label>Service Interested In <span class="text-danger">*</span></label>
                                    <select id="reference_name" name="reference_name" class="form-select" required>
                                        <option value="">Select a Service</option>
                                        <?php foreach ($services as $srv): ?>
                                            <option value="<?php echo htmlspecialchars($srv['service_name']); ?>">
                                                <?php echo htmlspecialchars($srv['service_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label>Additional Details / Message</label>
                            <textarea name="message" class="form-control" rows="4" placeholder="Describe your requirements..."></textarea>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" id="submit-btn" class="themeht-btn primary-btn">
                                <span>Submit Request</span><i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!--counter start-->
<section class="p-0 text-center">
  <div class="container">
    <div class="row">
     <div class="col">
      <div class="p-8 white-bg" data-bg-img="images/bg/02.png">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="counter">
              <div class="counter-desc">
                <span class="count-number" data-count="482">482</span>
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
                <span class="count-number" data-count="234">234</span>
                <span>+</span>
                <h5>Winning Awards</h5>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mt-6 mt-lg-0">
            <div class="counter">
              <div class="counter-desc">
                <span class="count-number" data-count="72">72</span>
                <span>K</span>
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

</div>
<!-- page wrapper end -->

<script>
function bookService(serviceName) {
    // Select the dropdown
    var select = document.getElementById('reference_name');
    if(select) {
        select.value = serviceName;
        
        // Disable changing the service dropdown once selected (as per requirement)
        // select.setAttribute('readonly', true); // Select doesn't support readonly
        // select.setAttribute('disabled', true); // Disabled fields are not sent in POST
        
        // Workaround: visual disable + hidden input if needed, or just pointer-events
        select.style.pointerEvents = 'none'; 
        select.style.backgroundColor = '#e9ecef';
        
        // Note: If we use 'disabled', we need a hidden input to send the value.
        // But pointer-events:none prevents clicking, which is enough for UI.
    }
    
    // Scroll to form
    var section = document.getElementById('booking-section');
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
    
    fetch('ajax_submit_service.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            msgDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
            form.reset();
            
            // Re-enable dropdown
            var select = document.getElementById('reference_name');
            if(select) {
                select.style.pointerEvents = 'auto';
                select.style.backgroundColor = '';
            }
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
        btn.innerHTML = '<span>Submit Request</span><i class="bi bi-arrow-right"></i>';
    });
}
</script>

<?php include("includes/footer.php"); ?>