<?php
?><!doctype html>
<html lang="en" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($title ?? 'Admin'); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #f7f8fa;
      --card: #ffffff;
      --text: #1f2937;
      --muted: #6b7280;
      --primary: #2563eb;
      --primary-contrast: #ffffff;
      --border: #e5e7eb;
      --sidebar-bg: #111827;
      --sidebar-text: #e5e7eb;
      --sidebar-muted: #9ca3af;
    }
    [data-theme="dark"] {
      --bg: #0b0e12;
      --card: #12161c;
      --text: #e5e7eb;
      --muted: #9ca3af;
      --primary: #3b82f6;
      --primary-contrast: #0b0e12;
      --border: #1f2937;
      --sidebar-bg: #0b0e12;
      --sidebar-text: #e5e7eb;
      --sidebar-muted: #6b7280;
    }
    html, body {
      height: 100%;
      background: var(--bg);
      color: var(--text);
      font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    }
    .app {
      display: flex;
      min-height: 100%;
    }
    .sidebar {
      width: 280px;
      background: var(--sidebar-bg);
      color: var(--sidebar-text);
      display: flex;
      flex-direction: column;
      border-right: 1px solid var(--border);
    }
    .brand {
      display: flex;
      align-items: center;
      gap: .75rem;
      padding: 1rem 1.25rem;
      border-bottom: 1px solid var(--border);
      color: var(--sidebar-text);
      text-decoration: none;
      font-weight: 600;
    }
    .brand i {
      font-size: 1.5rem;
      color: var(--primary);
    }
    .nav-section {
      padding: .75rem;
    }
    .nav-link {
      display: flex;
      align-items: center;
      gap: .75rem;
      padding: .65rem .75rem;
      border-radius: .5rem;
      color: var(--sidebar-text);
      text-decoration: none;
      transition: background .2s ease, color .2s ease;
    }
    .nav-link i {
      color: var(--sidebar-muted);
    }
    .nav-link:hover, .nav-link.active {
      background: rgba(37, 99, 235, .12);
      color: #fff;
    }
    .content {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: .75rem 1rem;
      border-bottom: 1px solid var(--border);
      background: var(--card);
      position: sticky;
      top: 0;
      z-index: 10;
      box-shadow: 0 1px 10px rgba(0,0,0,.06);
    }
    .top-actions {
      display: flex;
      align-items: center;
      gap: .5rem;
    }
    .btn-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: .5rem;
      border: 1px solid var(--border);
      background: transparent;
      color: var(--text);
    }
    .btn-primary-soft {
      background: rgba(37, 99, 235, .12);
      color: var(--primary);
      border: 1px solid rgba(37, 99, 235, .25);
    }
    .main-area {
      padding: 1.25rem;
    }
    .card-modern {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: .75rem;
      box-shadow: 0 1px 2px rgba(0,0,0,.04);
    }
    .kpi { transition: transform .15s ease, box-shadow .15s ease; }
    .kpi:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,.08); }
    .login-wrap {
      min-height: 100vh;
      display: grid;
      place-items: center;
      background: radial-gradient(1200px 600px at 10% 10%, rgba(37,99,235,.12), transparent 60%), radial-gradient(1200px 600px at 90% 90%, rgba(16,185,129,.10), transparent 60%), var(--bg);
    }
    .login-card {
      width: 100%;
      max-width: 420px;
      padding: 1.25rem;
    }
    .form-check-label, .form-label {
      color: var(--muted);
    }
    @media (max-width: 992px) {
      .sidebar {
        position: fixed;
        left: -280px;
        top: 0;
        bottom: 0;
        transition: left .2s ease;
      }
      .sidebar.open {
        left: 0;
      }
    }
  </style>
</head>
<body>
<?php if (empty($_SESSION['admin_id']) || !empty($force_login_layout)): ?>
  <div class="login-wrap">
    <div class="card-modern login-card">
      <div class="p-3">
        <?php echo $content ?? ''; ?>
      </div>
    </div>
  </div>
<?php else: ?>
  <div class="app">
    <aside class="sidebar" id="sidebar">
      <a class="brand" href="/Software-Services/admin/dashboard.php"><i class="fa-solid fa-graduation-cap"></i><span>Training Admin</span></a>
      <div class="nav-section">
        <a class="nav-link <?php echo ($title ?? '') === 'Dashboard' ? 'active' : ''; ?>" href="/Software-Services/admin/dashboard.php"><i class="fa-solid fa-house"></i><span>Dashboard</span></a>
        <a class="nav-link" href="/Software-Services/admin/banners.php"><i class="fa-regular fa-image"></i><span>Manage Banners</span></a>
        <a class="nav-link" href="/Software-Services/admin/courses.php"><i class="fa-solid fa-book"></i><span>Manage Courses</span></a>
        <a class="nav-link" href="/Software-Services/admin/trainings.php"><i class="fa-solid fa-layer-group"></i><span>Manage Trainings</span></a>
        <a class="nav-link <?php echo ($title ?? '') === 'Services' ? 'active' : ''; ?>" href="/Software-Services/admin/services.php"><i class="fa-solid fa-server"></i><span>Manage Services</span></a>
        <a class="nav-link" href="/Software-Services/admin/pages.php"><i class="fa-regular fa-file-lines"></i><span>Manage Pages</span></a>
        <a class="nav-link" href="/Software-Services/admin/gallery.php"><i class="fa-solid fa-images"></i><span>Manage Gallery</span></a>
        <a class="nav-link" href="/Software-Services/admin/enquiries.php"><i class="fa-regular fa-message"></i><span>Manage Enquiries</span></a>
        <a class="nav-link" href="/Software-Services/admin/enquiries.php?source=registration"><i class="fa-solid fa-users"></i><span>Users / Registrations</span></a>
        <a class="nav-link" href="/Software-Services/admin/pages.php"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
      </div>
      <div class="mt-auto p-3">
        <a class="nav-link" href="/Software-Services/admin/logout.php"><i class="fa-solid fa-right-from-brackets"></i><span>Logout</span></a>
      </div>
    </aside>
    <div class="content">
      <div class="topbar">
        <div class="d-flex align-items-center gap-2">
          <button class="btn-icon" id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
          <span class="fw-semibold"><?php echo htmlspecialchars($title ?? ''); ?></span>
        </div>
        <div class="top-actions">
          <a class="btn btn-primary-soft" href="/Software-Services/">View Site</a>
          <button class="btn-icon" id="toggleTheme" title="Toggle theme"><i class="fa-regular fa-sun"></i></button>
          <button class="btn-icon"><i class="fa-regular fa-bell"></i></button>
          <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
              <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="#">Change Password</a></li>
              <li><a class="dropdown-item" href="/Software-Services/admin/pages.php">Settings</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/Software-Services/admin/logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="main-area">
        <div class="container-fluid">
          <?php echo $content ?? ''; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  (function() {
    var s = document.documentElement;
    var theme = localStorage.getItem('admin-theme') || 'light';
    s.setAttribute('data-theme', theme);
    var toggleTheme = document.getElementById('toggleTheme');
    if (toggleTheme) {
      toggleTheme.addEventListener('click', function() {
        var t = s.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        s.setAttribute('data-theme', t);
        localStorage.setItem('admin-theme', t);
        toggleTheme.innerHTML = t === 'dark' ? '<i class="fa-regular fa-moon"></i>' : '<i class="fa-regular fa-sun"></i>';
      });
      toggleTheme.innerHTML = theme === 'dark' ? '<i class="fa-regular fa-moon"></i>' : '<i class="fa-regular fa-sun"></i>';
    }
    var toggleSidebar = document.getElementById('toggleSidebar');
    var sidebar = document.getElementById('sidebar');
    if (toggleSidebar && sidebar) {
      toggleSidebar.addEventListener('click', function() {
        sidebar.classList.toggle('open');
      });
    }
  })();
</script>
</body>
</html>
