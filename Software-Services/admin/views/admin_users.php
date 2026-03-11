<?php
declare(strict_types=1);

if (!empty($msg)) {
    echo "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . htmlspecialchars($msg) . "</div>";
}
if (!empty($error)) {
    echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . htmlspecialchars($error) . "</div>";
}
?>

<div class="card-modern">
    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
        <h5 class="mb-0">Manage Users</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fa-solid fa-plus me-1"></i> Add User
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>#
                            <?php echo $user['id']; ?>
                        </td>
                        <td class="fw-semibold">
                            <?php echo htmlspecialchars($user['username']); ?>
                        </td>
                        <td>
                            <?php if ($user['active']): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Disabled</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo date('M d, Y', strtotime($user['created_at'])); ?>
                        </td>
                        <td class="text-end">

                            <?php if ($_SESSION['admin_id'] !== $user['id']): ?>
                                <?php if (isset($_SESSION['revealed_passwords'][$user['id']])): ?>
                                    <!-- Viewing Revealed Password -->
                                    <button class="btn btn-sm btn-outline-success me-1 revealed-password-btn"
                                        data-password="<?php echo htmlspecialchars($_SESSION['revealed_passwords'][$user['id']]); ?>">
                                        <i class="fa-regular fa-eye-slash me-1"></i>
                                        <?php echo htmlspecialchars($_SESSION['revealed_passwords'][$user['id']]); ?>
                                    </button>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                        <input type="hidden" name="action" value="hide_password">
                                        <input type="hidden" name="target_user_id" value="<?php echo $user['id']; ?>">
                                        <button class="btn btn-sm btn-outline-secondary me-2"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </form>
                                <?php else: ?>
                                    <!-- Trigger Modal for Password -->
                                    <button class="btn btn-sm btn-outline-info me-2"
                                        onclick="openVerifyModal(<?php echo $user['id']; ?>, '<?php echo htmlspecialchars($user['username']); ?>')">
                                        <i class="fa-regular fa-eye me-1"></i> View Password
                                    </button>
                                <?php endif; ?>

                                <!-- Delete User -->
                                <form method="post" class="d-inline" onsubmit="return confirm('Delete this user?');">
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button class="btn btn-sm btn-outline-danger"><i
                                            class="fa-regular fa-trash-can"></i></button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted small">You (Current Session)</span>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4">No other users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" class="modal-content">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="action" value="create">
            <div class="modal-header">
                <h5 class="modal-title">Create New Admin User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label class="form-label">Temporary Password</label>
                    <input type="text" name="password" class="form-control" required autocomplete="off">
                    <small class="text-muted d-block mt-1">They will use this to login initially. You can view this
                        later by verifying your own admin password.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create User</button>
            </div>
        </form>
    </div>
</div>

<!-- Verify Admin Password Modal -->
<div class="modal fade" id="verifyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form method="post" class="modal-content border-info">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="action" value="verify_password">
            <input type="hidden" name="target_user_id" id="verifyTargetId" value="">

            <div class="modal-header bg-info-subtle">
                <h6 class="modal-title"><i class="fa-solid fa-lock text-info me-2"></i>Security Verification</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="small text-muted mb-3">To reveal the password for <strong id="verifyTargetName"
                        class="text-dark"></strong>, please verify your *own* admin password first.</p>
                <div class="mb-2">
                    <input type="password" name="admin_password" class="form-control text-center"
                        placeholder="Your Password" required autofocus>
                </div>
            </div>
            <div class="modal-footer p-2 d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-sm btn-info text-white">Unlock</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openVerifyModal(id, username) {
        document.getElementById('verifyTargetId').value = id;
        document.getElementById('verifyTargetName').innerText = username;
        var modal = new bootstrap.Modal(document.getElementById('verifyModal'));
        modal.show();
    }

    document.querySelectorAll('.revealed-password-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            navigator.clipboard.writeText(this.getAttribute('data-password'));
            var originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fa-solid fa-check"></i> Copied!';
            setTimeout(() => { this.innerHTML = originalHTML; }, 2000);
        });
    });
</script>