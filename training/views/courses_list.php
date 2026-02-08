<?php
// Ensure $base is set (provided by router)
$grouped_courses = [];
if (!empty($courses)) {
    foreach ($courses as $c) {
        $cat = !empty($c['level']) ? $c['level'] : 'Other Courses';
        $grouped_courses[$cat][] = $c;
    }
}
?>
<div class="row justify-content-center text-center mb-5">
  <div class="col-lg-8 col-md-12">
    <div class="theme-title">
      <h6>Enhance Your Skills</h6>
      <h2>Professional Training Courses</h2>
      <p>Comprehensive training programs designed to help you master new skills and advance your career.</p>
    </div>
  </div>
</div>

<?php if (empty($grouped_courses)): ?>
    <div class="row justify-content-center">
        <div class="col-12 text-center"><p class="text-muted">No courses available at the moment.</p></div>
    </div>
<?php else: ?>
    <?php foreach ($grouped_courses as $category => $items): ?>
        <div class="mb-5">
            <div class="row" style="margin-bottom: 80px;">
                <div class="col-12 text-center">
                    <h3 class="d-inline-block pb-2 position-relative" style="border-bottom: 3px solid #2563eb; color: #131d2a;">
                        <?php echo htmlspecialchars($category); ?>
                    </h3>
                </div>
            </div>
            <div class="row gx-lg-5 justify-content-center">
                <?php foreach ($items as $c): ?>
                    <?php include __DIR__ . '/../../Software-Services/includes/course_card.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Inquiry Form Section -->
<section id="inquiry-section" class="bg-light position-relative mt-5">
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
    
    // Use absolute path to Software-Services API
    fetch('/Software-Services/ajax_submit_inquiry.php', {
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
