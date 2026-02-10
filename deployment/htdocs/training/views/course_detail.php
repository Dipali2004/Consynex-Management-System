<?php
?>
<div class="row">
  <div class="col-12">
    <h2><?php echo htmlspecialchars($course['name']); ?></h2>
    <?php if (!empty($course['image_path'])): ?>
      <div class="mb-3"><img src="<?php echo htmlspecialchars($course['image_path']); ?>" alt="<?php echo htmlspecialchars($course['name']); ?>" style="max-height:220px;width:auto"></div>
    <?php endif; ?>
    <div class="mb-2">Duration: <?php echo htmlspecialchars((string)$course['duration']); ?> | Level: <?php echo htmlspecialchars((string)($course['level'] ?? '')); ?> | Fees: <?php echo htmlspecialchars((string)$course['fees']); ?></div>
    <p><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
    <div class="mt-4">
      <h4>Enquiry / Registration</h4>
      <form method="post" action="<?php echo $base; ?>/contact-submit">
        <input type="hidden" name="source" value="registration">
        <div class="row">
          <div class="col-md-6 mb-2">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
          </div>
          <div class="col-md-6 mb-2">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="col-md-6 mb-2">
            <input type="text" name="phone" class="form-control" placeholder="Phone">
          </div>
          <div class="col-12 mb-2">
            <textarea name="message" class="form-control" placeholder="Message (include course interest)" rows="4" required></textarea>
          </div>
        </div>
        <button class="btn btn-success">Submit Enquiry</button>
      </form>
    </div>
  </div>
</div>
