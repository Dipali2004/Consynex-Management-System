<div class="mb-4 text-center">
  <img src="/Software-Services/images/companyLogo.png" alt="Consynex Technologies" style="max-height: 80px;">
</div>
<div class="mb-2">
  <div class="d-flex align-items-center justify-content-between">
    <div class="h4 m-0">Reset Password</div>
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
    <div class="mb-3">
      <label class="form-label">Email Address</label>
      <input type="email" name="email" class="form-control" placeholder="admin@example.com" required>
      <div class="form-text">We'll send you a reset link if this email is registered.</div>
    </div>
    <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
  </form>
<?php endif; ?>
