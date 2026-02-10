<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

$images = [];
$categories = [];
try {
    $pdo = Database::conn();
    $stmt = $pdo->query("SELECT * FROM gallery WHERE status = 1 ORDER BY created_at DESC");
    $images = $stmt->fetchAll();
    
    // Get unique categories
    $categories = array_unique(array_column($images, 'category'));
    sort($categories);
} catch (Exception $e) {
    // Handle error silently
}

include("includes/header.php");
?>

<!--page title start-->
<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1><span>Our</span> Gallery</h1>
        <!-- <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php"><i class="bi bi-house-door me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Gallery</li>
          </ol>
        </nav> -->
      </div>
    </div>
  </div>
  <div class="wave-shape">
    <svg width="100%" height="150px" fill="none">
      <path fill="white">
        <animate repeatCount="indefinite" fill="freeze" attributeName="d" dur="10s" values="
          M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z;
          M0 86.3149C316 86.315 444 159.155 884 51.1554C1324 -56.8446 1320.29 34.1214 1538 70.4063C1814 116.407 2156 188.408 2560 86.315V232.317L0 232.316V86.3149Z;
          M0 53.6584C158 11.0001 213 0 363 0C513 0 855.555 115.001 1154 115.001C1440 115.001 1626 -38.0004 2560 53.6585V199.66L0 199.66V53.6584Z;
          M0 25.9086C277 84.5821 433 65.736 720 25.9086C934.818 -3.9019 1214.06 -5.23669 1442 8.06597C2079 45.2421 2208 63.5007 2560 25.9088V171.91L0 171.91V25.9086Z"></animate>
      </path>
    </svg>
  </div>
</section>
<!--page title end-->

<div class="page-content">

<section>
  <div class="container">
    
    <!-- Filter Buttons -->
    <?php if (!empty($categories)): ?>
    <div class="row mb-5">
        <div class="col-12 text-center">
            <div class="portfolio-filter justify-content-center">
                <button data-filter="*" class="active">All</button>
                <?php foreach ($categories as $cat): ?>
                    <button data-filter=".cat-<?php echo preg_replace('/[^a-z0-9]/i', '', strtolower($cat)); ?>"><?php echo htmlspecialchars($cat); ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Gallery Grid -->
    <?php if (empty($images)): ?>
        <div class="text-center py-5">
            <p class="text-muted">No images available in the gallery.</p>
        </div>
    <?php else: ?>
        <div class="row g-4 popup-gallery" id="gallery-grid">
            <?php foreach ($images as $img): ?>
                <?php 
                    $catClass = 'cat-' . preg_replace('/[^a-z0-9]/i', '', strtolower($img['category'])); 
                ?>
                <div class="col-lg-4 col-md-6 gallery-item <?php echo $catClass; ?>">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden hover-lift">
                        <div class="position-relative overflow-hidden">
                            <a href="<?php echo htmlspecialchars($img['image_path']); ?>" class="popup-img" title="<?php echo htmlspecialchars($img['title']); ?>">
                                <img class="img-fluid w-100 object-fit-cover" 
                                     src="<?php echo htmlspecialchars($img['image_path']); ?>" 
                                     alt="<?php echo htmlspecialchars($img['title']); ?>" 
                                     style="height: 250px; transition: transform 0.5s ease;"
                                     loading="lazy">
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-25 opacity-0 hover-opacity-100 transition-opacity">
                                    <i class="bi bi-zoom-in text-white fs-1"></i>
                                </div>
                            </a>
                        </div>
                        <?php if (!empty($img['title'])): ?>
                        <div class="card-body text-center p-3">
                            <h5 class="card-title h6 mb-0"><?php echo htmlspecialchars($img['title']); ?></h5>
                            <small class="text-muted"><?php echo htmlspecialchars($img['category']); ?></small>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
  </div>
</section>

</div>

<style>
.portfolio-filter button {
    background: transparent;
    border: none;
    color: #666;
    padding: 5px 15px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin: 0 5px;
    position: relative;
}
.portfolio-filter button.active, .portfolio-filter button:hover {
    color: #2563eb;
}
.portfolio-filter button.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 15px;
    right: 15px;
    height: 2px;
    background: #2563eb;
}
.hover-lift:hover img {
    transform: scale(1.05) !important;
}
.transition-opacity {
    transition: opacity 0.3s ease;
}
.hover-opacity-100:hover {
    opacity: 1 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.portfolio-filter button');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            galleryItems.forEach(item => {
                if (filterValue === '*' || item.classList.contains(filterValue.substring(1))) {
                    item.style.display = 'block';
                    // Trigger animation (optional)
                    item.classList.add('animate__animated', 'animate__fadeIn');
                } else {
                    item.style.display = 'none';
                    item.classList.remove('animate__animated', 'animate__fadeIn');
                }
            });
        });
    });
});
</script>

<?php include("includes/footer.php"); ?>
