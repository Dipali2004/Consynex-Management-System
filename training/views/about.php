<?php
?>
<div class="row">
  <div class="col-12">
    <h2><?php echo htmlspecialchars(($page['title'] ?? 'About Us')); ?></h2>
    <p><?php echo nl2br(htmlspecialchars(($page['content'] ?? ''))); ?></p>
  </div>
</div>

