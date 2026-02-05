<?php
?>
<div class="row">
  <div class="col-md-6">
    <h2>Contact Us</h2>
    <form method="post" action="<?php echo $base; ?>/contact-submit">
      <div class="mb-2">
        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
      </div>
      <div class="mb-2">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="mb-2">
        <input type="text" name="phone" class="form-control" placeholder="Phone">
      </div>
      <div class="mb-2">
        <textarea name="message" class="form-control" rows="5" placeholder="Message" required></textarea>
      </div>
      <button class="btn btn-primary">Send</button>
    </form>
    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success mt-3">Thanks. We will contact you soon.</div>
    <?php elseif (isset($_GET['error'])): ?>
      <div class="alert alert-danger mt-3">Please fill required fields correctly.</div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <h3>Details</h3>
    <p><?php echo nl2br(htmlspecialchars(($page['content'] ?? ''))); ?></p>
    <?php $data = !empty($page['data_json']) ? json_decode($page['data_json'], true) : []; ?>
    <?php if (!empty($data)): ?>
      <ul class="list-unstyled">
        <?php if (!empty($data['phone'])): ?><li>Phone: <?php echo htmlspecialchars($data['phone']); ?></li><?php endif; ?>
        <?php if (!empty($data['email'])): ?><li>Email: <?php echo htmlspecialchars($data['email']); ?></li><?php endif; ?>
        <?php if (!empty($data['address'])): ?><li>Address: <?php echo htmlspecialchars($data['address']); ?></li><?php endif; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>
