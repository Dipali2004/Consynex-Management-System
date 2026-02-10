<?php
?>
<div class="row">
  <div class="col-12">
    <h2>Training Programs</h2>
  </div>
  <?php foreach ($items as $t): ?>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($t['name']); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars(mb_strimwidth($t['description'], 0, 140, '...')); ?></p>
          <a href="<?php echo $base; ?>/training/<?php echo urlencode($t['slug']); ?>" class="btn btn-primary mt-2">Details</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
