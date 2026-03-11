<?php
/**
 * Course Card Component
 * 
 * Expects $c to be an associative array with course details.
 * Fields: image_path, name, description, slug.
 */

// Normalize image path
$rawImage = !empty($c['image_path']) ? $c['image_path'] : ($c['image'] ?? '');
$imgSrc = '';

if (!empty($rawImage)) {
    if (strpos($rawImage, 'http') === 0) {
        $imgSrc = $rawImage;
    } else {
        // The path is relative to the `uploads` directory, which is at the root of the `Software-Services` folder.
        $imgSrc = 'uploads/courses/' . ltrim($rawImage, '/');
    }
} else {
    // Default image
    $imgSrc = '/Software-Services/images/service-icon/01.png';
}

// Truncate description
$description = mb_strimwidth(strip_tags($c['description'] ?? ''), 0, 100, '...');

// Fallback for course name
$courseName = !empty($c['name']) ? $c['name'] : ($c['course_name'] ?? 'Untitled Course');
?>

<div class="col-lg-4 col-md-6 mb-5">
    <div class="service-item style-1 h-100 d-flex flex-column">
        <div class="service-images mb-2" style="min-height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 8px;">
            <img class="img-fluid" src="<?php echo htmlspecialchars($imgSrc); ?>" alt="<?php echo htmlspecialchars($courseName); ?>" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
        <div class="service-desc">
            <div class="service-title">
                <h4><?php echo htmlspecialchars($courseName); ?></h4>
            </div>
            <p class="mb-1"><?php echo htmlspecialchars($description); ?></p>
            
            <div class="mt-auto d-flex flex-wrap gap-2">
                <a class="btn btn-outline-primary btn-sm rounded-pill px-4 flex-grow-1" href="/training/course/<?php echo htmlspecialchars($c['slug']); ?>">
                    View Course <i class="bi bi-arrow-right-short"></i>
                </a>
                <?php if (empty($hideEnquiryButton)): ?>
                <button class="btn btn-outline-primary btn-sm rounded-pill px-4 flex-grow-1" onclick='openInquiryForm(<?php echo json_encode($courseName); ?>)'>
                    Enquire Now <i class="bi bi-arrow-right-short"></i>
                </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
