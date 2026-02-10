<?php
?>
<div class="row">
  <div class="col-12">
    <h2><?php echo htmlspecialchars($item['name']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
    <div class="mt-4">
      <h4>Enquiry</h4>
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
            <textarea name="message" class="form-control" placeholder="Message (include program interest)" rows="4" required></textarea>
          </div>
        </div>
        <button class="btn btn-success">Submit Enquiry</button>
      </form>
    </div>
  </div>
</div>
