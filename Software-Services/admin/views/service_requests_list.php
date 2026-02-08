<?php
// Filtering
$status_filter = $_GET['status_filter'] ?? '';
?>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Customer Service Requests</h5>
    <form class="d-flex" action="services.php" method="GET">
        <input type="hidden" name="tab" value="requests">
        <select name="status_filter" class="form-select form-select-sm me-2" onchange="this.form.submit()">
            <option value="">All Statuses</option>
            <option value="Pending" <?php echo $status_filter === 'Pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="Assigned" <?php echo $status_filter === 'Assigned' ? 'selected' : ''; ?>>Assigned</option>
            <option value="Completed" <?php echo $status_filter === 'Completed' ? 'selected' : ''; ?>>Completed</option>
            <option value="Cancelled" <?php echo $status_filter === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
        </select>
    </form>
</div>

<?php if (!empty($msg)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($msg); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($requests) > 0): ?>
                        <?php foreach ($requests as $req): ?>
                            <tr>
                                <td>#<?php echo $req['id']; ?></td>
                                <td>
                                    <div><?php echo date('M d, Y', strtotime($req['created_at'])); ?></div>
                                    <small class="text-muted"><?php echo date('h:i A', strtotime($req['created_at'])); ?></small>
                                </td>
                                <td>
                                    <div class="fw-bold"><?php echo htmlspecialchars($req['customer_name']); ?></div>
                                    <small class="text-muted"><i class="fa-solid fa-phone me-1"></i><?php echo htmlspecialchars($req['mobile']); ?></small>
                                    <div class="small text-muted"><i class="fa-solid fa-envelope me-1"></i><?php echo htmlspecialchars($req['email']); ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?php echo htmlspecialchars($req['service_name']); ?></span>
                                    <?php if(!empty($req['message'])): ?>
                                        <div class="small mt-1 text-muted text-truncate" style="max-width: 200px;">
                                            <i class="fa-regular fa-comment me-1"></i><?php echo htmlspecialchars($req['message']); ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                    $badgeClass = match($req['status']) {
                                        'New', 'Pending' => 'bg-warning text-dark',
                                        'Assigned' => 'bg-info text-dark',
                                        'Completed' => 'bg-success',
                                        'Cancelled' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                    ?>
                                    <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($req['status']); ?></span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><h6 class="dropdown-header">Update Status</h6></li>
                                            <li><a class="dropdown-item" href="services.php?tab=requests&action=update_status&id=<?php echo $req['id']; ?>&status=Pending">Pending</a></li>
                                            <li><a class="dropdown-item" href="services.php?tab=requests&action=update_status&id=<?php echo $req['id']; ?>&status=Assigned">Assigned</a></li>
                                            <li><a class="dropdown-item" href="services.php?tab=requests&action=update_status&id=<?php echo $req['id']; ?>&status=Completed">Completed</a></li>
                                            <li><a class="dropdown-item" href="services.php?tab=requests&action=update_status&id=<?php echo $req['id']; ?>&status=Cancelled">Cancelled</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="services.php?tab=requests&action=delete_request&id=<?php echo $req['id']; ?>" onclick="return confirm('Delete this request permanently?')">Delete</a></li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-secondary ms-1" data-bs-toggle="modal" data-bs-target="#requestModal<?php echo $req['id']; ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No service requests found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals -->
<?php if (count($requests) > 0): ?>
    <?php foreach ($requests as $req): ?>
        <?php 
        $badgeClass = match($req['status']) {
            'Pending' => 'bg-warning text-dark',
            'Assigned' => 'bg-info text-dark',
            'Completed' => 'bg-success',
            'Cancelled' => 'bg-danger',
            default => 'bg-secondary'
        };
        ?>
        <div class="modal fade" id="requestModal<?php echo $req['id']; ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Request Details #<?php echo $req['id']; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-bold">Customer:</label>
                            <div><?php echo htmlspecialchars($req['customer_name']); ?></div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Contact:</label>
                            <div>Phone: <?php echo htmlspecialchars($req['mobile']); ?></div>
                            <div>Email: <?php echo htmlspecialchars($req['email']); ?></div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Service:</label>
                            <div><?php echo htmlspecialchars($req['service_name']); ?></div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Message:</label>
                            <div class="p-2 bg-light rounded"><?php echo nl2br(htmlspecialchars($req['message'])); ?></div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Status:</label>
                            <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($req['status']); ?></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>