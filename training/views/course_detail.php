<?php
$imgSrc = $course['image_path'] ?? '';
if (!empty($imgSrc)) {
    if (strpos($imgSrc, 'http') !== 0 && strpos($imgSrc, '/') !== 0) {
        // Assume it's relative to Software-Services/
        $imgSrc = '/Software-Services/' . $imgSrc;
    }
} else {
    $imgSrc = '/Software-Services/images/service-icon/01.png';
}
?>

<div class="row align-items-center mb-5">
  <div class="col-lg-6 mb-4 mb-lg-0">
    <div class="position-relative overflow-hidden rounded-3 shadow-sm border">
        <img src="<?php echo htmlspecialchars($imgSrc); ?>" 
             alt="<?php echo htmlspecialchars($course['name']); ?>" 
             class="img-fluid w-100 object-fit-cover" 
             style="height: 400px;">
    </div>
  </div>
  <div class="col-lg-6 ps-lg-5">
    <div class="course-header">
        <span class="badge bg-primary px-3 py-2 mb-3 rounded-pill text-uppercase"><?php echo htmlspecialchars($course['level'] ?? 'Professional'); ?></span>
        <h2 class="display-6 fw-bold mb-3"><?php echo htmlspecialchars($course['name']); ?></h2>
        
        <div class="d-flex align-items-center mb-4 text-muted">
            <span class="me-4"><i class="bi bi-clock me-2 text-primary"></i> <strong>Duration:</strong> <?php echo htmlspecialchars((string)$course['duration']); ?></span>
            <?php if (!empty($course['fees'])): ?>
                <span><i class="bi bi-currency-dollar me-2 text-primary"></i> <strong>Fees:</strong> <?php echo htmlspecialchars((string)$course['fees']); ?></span>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <h4 class="h5 mb-3">Course Description</h4>
            <p class="text-muted lead-sm" style="line-height: 1.6;"><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
        </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card border-0 shadow-sm bg-light">
      <div class="card-body p-4 p-lg-5">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h4 class="fw-bold mb-3">Enquiry / Registration</h4>
                <p class="text-muted">Fill out the form to receive complete syllabus and schedule details.</p>
                <div class="mt-4 d-none d-lg-block">
                    <i class="bi bi-patch-check-fill text-success me-2"></i> Industry recognized certification<br>
                    <i class="bi bi-patch-check-fill text-success me-2"></i> Hands-on practical training<br>
                    <i class="bi bi-patch-check-fill text-success me-2"></i> 100% Placement assistance
                </div>
            </div>
            <div class="col-lg-8">
                <form method="post" action="<?php echo $base; ?>/contact-submit">
                    <input type="hidden" name="source" value="registration">
                    <input type="hidden" name="course_name" value="<?php echo htmlspecialchars($course['name']); ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label small fw-bold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone">
                        </div>
                        <div class="col-12 mb-4">
                            <label class="form-label small fw-bold">Message</label>
                            <textarea name="message" class="form-control" placeholder="I'm interested in this course. Please share more details." rows="3" required></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">Submit Enquiry <i class="bi bi-arrow-right ms-2"></i></button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
