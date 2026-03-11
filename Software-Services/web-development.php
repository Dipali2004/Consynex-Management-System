<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

$web_dev_services = [];
try {
    $pdo = Database::conn();
    $stmt = $pdo->prepare("SELECT * FROM services WHERE status = 1 AND category = ? ORDER BY service_name ASC");
    $stmt->execute(['Web Development']);
    $web_dev_services = $stmt->fetchAll();
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
        <h1><span>Web</span> Development</h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door me-1"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="services.php">Services</a></li>
            <li class="breadcrumb-item active" aria-current="page">Web Development</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
<!--page title end-->

<!--body content start-->
<div class="page-content">

<section>
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-8 col-md-12">
        <div class="theme-title">
          <h6>Our Offerings</h6>
          <h2>Expert Web Development Services</h2>
          <p>We build high-quality, scalable, and feature-rich web solutions tailored to your business needs.</p>
        </div>
      </div>
    </div>
    
    <?php if (empty($web_dev_services)): ?>
        <div class="text-center py-5">
            <p class="text-muted">No web development services are available at the moment. Please check back later.</p>
        </div>
    <?php else: ?>
        <div class="row gx-lg-5 text-center justify-content-center">
            <?php foreach ($web_dev_services as $srv): ?>
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="service-item style-1 h-100 d-flex flex-column">
                    <div class="service-images mb-4 d-flex align-items-center justify-content-center" style="min-height: 80px;">
                        <?php if (strpos($srv['icon'], 'bi-') !== false || strpos($srv['icon'], 'fa-') !== false): ?>
                            <i class="<?php echo htmlspecialchars($srv['icon']); ?>" style="font-size: 3.5rem; color: #2563eb;"></i>
                        <?php elseif (!empty($srv['icon'])):
                            $icon_path = 'uploads/services/' . $srv['icon'];
                        ?>
                            <img class="img-fluid" src="<?php echo htmlspecialchars($icon_path); ?>" alt="" style="max-height: 80px;">
                        <?php else: ?>
                            <i class="bi bi-code-slash" style="font-size: 3.5rem; color: #2563eb;"></i>
                        <?php endif; ?>
                    </div>
                    <div class="service-desc">
                        <div class="service-title">
                            <h4><?php echo htmlspecialchars($srv['service_name']); ?></h4>
                        </div>
                        <p class="mb-0"><?php echo htmlspecialchars($srv['description']); ?></p>
                        <div class="mt-3">
                            <a href="services.php?service=<?php echo urlencode($srv['service_name']); ?>#booking-section" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                Book Now <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
  </div>
</section>

</div>
<!-- page wrapper end -->

<?php include("includes/footer.php"); ?>