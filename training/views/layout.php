<?php
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($title ?? 'Training Institute'); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
$base = isset($base) ? $base : rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$adminBase = '/Software-Services/admin';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?php echo $base; ?>/">Training Institute</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/Software-Services/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/courses">Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/trainings">Training Programs</a></li>
        <li class="nav-item"><a class="nav-link" href="/Software-Services/about-us.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="/Software-Services/contact.php">Contact</a></li>
      </ul>
      <a class="btn btn-outline-primary" href="<?php echo $adminBase; ?>/index.php">Admin</a>
    </div>
  </div>
  </nav>
<main class="py-4">
  <div class="container">
    <?php echo $content ?? ''; ?>
  </div>
</main>
<footer class="bg-dark text-white py-4 mt-auto">
  <div class="container">
    <div class="d-flex justify-content-between">
      <div>&copy; <?php echo date('Y'); ?> Training Institute</div>
      <div><a class="text-white" href="/training/contact">Contact</a></div>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
