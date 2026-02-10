<?php
require_once __DIR__ . '/admin/bootstrap.php';
use TrainingApp\App\Database;

$id = $_GET['id'] ?? null;
$course = null;

if ($id) {
    try {
        $pdo = Database::conn();
        $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ? AND status = '1'");
        $stmt->execute([$id]);
        $course = $stmt->fetch();
    } catch (Exception $e) {
        // Handle error
    }
}

if (!$course) {
    header("Location: courses.php");
    exit;
}

include("includes/header.php");
?>

<!--page title start-->
<section class="page-title">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8 col-md-12">
        <h1><?php echo htmlspecialchars($course['course_name']); ?></h1>
        <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php"><i class="bi bi-house-door me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="courses.php">Courses</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
          </ol>
        </nav>
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
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12 mb-5 mb-lg-0">
        <div class="position-relative overflow-hidden rounded-3 shadow-lg">
            <?php if (!empty($course['image']) && file_exists(__DIR__ . '/' . $course['image'])): ?>
                <img class="img-fluid w-100 object-fit-cover" src="<?php echo htmlspecialchars($course['image']); ?>" alt="<?php echo htmlspecialchars($course['course_name']); ?>" style="height: 400px;">
            <?php else: ?>
                <div class="bg-light w-100 d-flex align-items-center justify-content-center text-muted" style="height: 400px;">
                    <i class="bi bi-card-image" style="font-size: 5rem; opacity: 0.3;"></i>
                </div>
            <?php endif; ?>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="ps-lg-5">
            <span class="badge bg-primary px-3 py-2 mb-3 rounded-pill"><?php echo htmlspecialchars($course['category']); ?></span>
            <h2 class="mb-3 display-5 fw-bold"><?php echo htmlspecialchars($course['course_name']); ?></h2>
            
            <div class="d-flex align-items-center mb-4 text-muted">
                <span class="me-4 fs-5"><i class="bi bi-clock me-2 text-primary"></i> <?php echo htmlspecialchars($course['duration']); ?></span>
                <span class="fs-4 fw-bold text-dark">₹<?php echo htmlspecialchars($course['fees']); ?></span>
            </div>
            
            <div class="mb-5">
                <h4 class="h5 mb-3 text-dark">About This Course</h4>
                <p class="lead text-muted"><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
            </div>
            
            <div class="d-flex gap-3">
                <button class="btn btn-success btn-lg rounded-pill px-4 shadow-sm hover-lift" onclick="sendInquiry('<?php echo htmlspecialchars($course['course_name'], ENT_QUOTES); ?>', <?php echo $course['id']; ?>)">
                    <i class="bi bi-whatsapp me-2"></i> Get Details on WhatsApp
                </button>
                <a href="courses.php" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                    View All Courses
                </a>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

</div>

<script>
function sendInquiry(courseName, courseId) {
    // AJAX to log inquiry
    if (courseId) {
        fetch('ajax_track_inquiry.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ course_id: courseId, type: 'WhatsApp' })
        }).catch(err => console.error(err));
    }
    
    // Open WhatsApp
    const mobile = '<?php echo ADMIN_MOBILE; ?>';
    const message = encodeURIComponent(`Hello, I’m interested in the ${courseName} course. Please share details.`);
    const url = `<?php echo WHATSAPP_API_URL; ?>${mobile}?text=${message}`;
    window.open(url, '_blank');
}
</script>

<?php include("includes/footer.php"); ?>
