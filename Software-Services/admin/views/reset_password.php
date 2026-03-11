<div class="mb-4 text-center">
  <img src="/Software-Services/images/companyLogo.png" alt="Consynex Technologies" style="max-height: 80px;">
</div>
<div class="mb-2">
  <div class="d-flex align-items-center justify-content-between">
    <div class="h4 m-0">Set New Password</div>
    <a href="/Software-Services/admin/login.php" class="text-decoration-none">Back to login</a>
  </div>
</div>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<?php if (!empty($success)): ?>
  <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
<?php else: ?>
  <form method="post" class="mt-2">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token ?? ''); ?>">
    <div class="mb-3 position-relative">
      <label class="form-label">New Password</label>
      <div class="input-group">
        <input type="password" name="password" class="form-control" id="newPassword" placeholder="Enter new password" required>
        <button type="button" class="btn btn-outline-secondary" id="toggleNewPwd"><i class="fa-regular fa-eye"></i></button>
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Confirm New Password</label>
      <input type="password" name="confirm_password" class="form-control" id="confirmPassword" placeholder="Confirm new password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
  </form>
<?php endif; ?>

<script>
  (function() {
    var btn = document.getElementById('toggleNewPwd');
    var field = document.getElementById('newPassword');
    var confirmField = document.getElementById('confirmPassword');
    if (btn && field && confirmField) {
      btn.addEventListener('click', function() {
        var t = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', t);
        confirmField.setAttribute('type', t);
        btn.innerHTML = t === 'password' ? '<i class="fa-regular fa-eye"></i>' : '<i class="fa-regular fa-eye-slash"></i>';
      });
    }
  })();
</script>
