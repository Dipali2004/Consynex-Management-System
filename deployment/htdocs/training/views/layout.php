<?php
// layout.php - Wrapper to integrate Training Module with Main Website UI

// Helper to fix relative paths from Software-Services includes
function fix_paths($html) {
    // 1. Fix CSS/JS/Images folders
    $html = preg_replace('/(href|src)="css\//', '$1="/Software-Services/css/', $html);
    $html = preg_replace('/(href|src)="js\//', '$1="/Software-Services/js/', $html);
    $html = preg_replace('/(href|src|data-bg-img)="images\//', '$1="/Software-Services/images/', $html);
    
    // 2. Fix PHP file links (e.g., index.php -> /Software-Services/index.php)
    // Matches href="filename.php" but ignores http, /, or #
    $html = preg_replace('/(href|src)="(?!(http|\/|#))([^"]+\.php)"/', '$1="/Software-Services/$3"', $html);
    
    return $html;
}

// 1. Capture and process Header
ob_start();
include __DIR__ . '/../../Software-Services/includes/header.php';
$header = ob_get_clean();

// Inject dynamic title if set
if (isset($title)) {
    $header = preg_replace('/<title>.*?<\/title>/', '<title>' . htmlspecialchars($title) . ' - CONSYNEX TECHNOLOGIES</title>', $header);
}

// Apply path fixes to header
echo fix_paths($header);
?>

<!-- Training Module Content Start -->
<div class="page-content">
    <section>
        <div class="container">
            <?php echo $content ?? ''; ?>
        </div>
    </section>
</div>
<!-- Training Module Content End -->

<?php
// 2. Capture and process Footer
ob_start();
include __DIR__ . '/../../Software-Services/includes/footer.php';
$footer = ob_get_clean();

// Apply path fixes to footer
echo fix_paths($footer);
?>