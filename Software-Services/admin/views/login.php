<?php
?>
<div class="mb-2">
  <div class="d-flex align-items-center justify-content-between">
    <div class="h4 m-0">Sign in</div>
    <a href="/training/" class="text-decoration-none">Back to site</a>
  </div>
</div>
<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method="post" class="mt-2">
  <div class="mb-3">
    <label class="form-label">Email or Username</label>
    <input type="text" name="username" class="form-control" placeholder="admin" required>
  </div>
  <div class="mb-3 position-relative">
    <label class="form-label">Password</label>
    <div class="input-group">
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
      <button type="button" class="btn btn-outline-secondary" id="togglePwd"><i class="ri-eye-line"></i></button>
    </div>
  </div>
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="remember">
      <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <a href="#" class="text-decoration-none">Forgot password?</a>
  </div>
  <button class="btn btn-primary w-100">Login</button>
</form>
<script>
  (function() {
    var btn = document.getElementById('togglePwd');
    var field = document.getElementById('password');
    if (btn && field) {
      btn.addEventListener('click', function() {
        var t = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', t);
        btn.innerHTML = t === 'password' ? '<i class="ri-eye-line"></i>' : '<i class="ri-eye-off-line"></i>';
      });
    }
  })();
</script>
