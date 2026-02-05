<?php
?>
<?php if (!empty($msg)): ?><div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
<div class="row">
  <div class="col-md-6">
    <h3>About Us</h3>
    <form method="post">
      <input type="hidden" name="key" value="about">
      <div class="mb-2"><input class="form-control" name="title" value="<?php echo htmlspecialchars($about['title'] ?? 'About Us'); ?>"></div>
      <div class="mb-2"><textarea class="form-control" name="content" rows="8"><?php echo htmlspecialchars($about['content'] ?? ''); ?></textarea></div>
      <button class="btn btn-primary">Save</button>
    </form>
  </div>
  <div class="col-md-6">
    <h3>Contact Details</h3>
    <?php $cdata = !empty($contact['data_json']) ? json_decode($contact['data_json'], true) : []; ?>
    <form method="post">
      <input type="hidden" name="key" value="contact">
      <div class="mb-2"><input class="form-control" name="title" value="<?php echo htmlspecialchars($contact['title'] ?? 'Contact Us'); ?>"></div>
      <div class="mb-2"><textarea class="form-control" name="content" rows="6"><?php echo htmlspecialchars($contact['content'] ?? ''); ?></textarea></div>
      <div class="mb-2"><input class="form-control" name="data[phone]" value="<?php echo htmlspecialchars($cdata['phone'] ?? ''); ?>" placeholder="Phone"></div>
      <div class="mb-2"><input class="form-control" name="data[email]" value="<?php echo htmlspecialchars($cdata['email'] ?? ''); ?>" placeholder="Email"></div>
      <div class="mb-2"><input class="form-control" name="data[address]" value="<?php echo htmlspecialchars($cdata['address'] ?? ''); ?>" placeholder="Address"></div>
      <button class="btn btn-primary">Save</button>
    </form>
  </div>
</div>

