<?php
?>
<div class="row">
  <div class="col-12">
    <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php foreach ($banners as $i => $b): ?>
          <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
            <img src="<?php echo htmlspecialchars($b['image_path']); ?>" class="d-block w-100" alt="">
            <?php if (!empty($b['title'])): ?>
              <div class="carousel-caption d-none d-md-block">
                <h5><?php echo htmlspecialchars($b['title']); ?></h5>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</div>
<div class="row mt-4">
  <div class="col-12">
    <h2>Welcome</h2>
    <p><?php echo htmlspecialchars($intro['content'] ?? ''); ?></p>
  </div>
</div>
<div class="row mt-4">
  <div class="col-12 d-flex justify-content-between align-items-center">
    <h3>Featured Courses</h3>
    <a class="btn btn-link" href="<?php echo $base; ?>/courses">View all</a>
  </div>
  <?php foreach ($courses as $c): ?>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($c['name']); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars(mb_strimwidth($c['description'], 0, 120, '...')); ?></p>
          <a href="<?php echo $base; ?>/course/<?php echo urlencode($c['slug']); ?>" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
