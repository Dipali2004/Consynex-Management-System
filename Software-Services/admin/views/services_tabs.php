<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Services Management</h2>
</div>

<!-- Tabs Navigation -->
<ul class="nav nav-tabs mb-4" id="servicesTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link <?php echo $active_tab === 'manage' ? 'active' : ''; ?>" href="services.php?tab=manage">
            <i class="fa-solid fa-list-check me-2"></i>Manage Services
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?php echo $active_tab === 'requests' ? 'active' : ''; ?>" href="services.php?tab=requests">
            <i class="fa-solid fa-inbox me-2"></i>Service Requests
            <?php if (isset($pending_count) && $pending_count > 0): ?>
                <span class="badge bg-danger rounded-pill ms-2"><?php echo $pending_count; ?></span>
            <?php endif; ?>
        </a>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="servicesTabContent">
    <div class="tab-pane fade show active">
        <?php if ($active_tab === 'manage'): ?>
            <!-- Manage Services Content -->
            <div class="mb-3 text-end">
                <a href="services.php?action=add" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add Service</a>
            </div>
            
            <?php if (!empty($msg)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($msg); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="10%">Icon</th>
                                    <th width="20%">Service Name</th>
                                    <th width="15%">Category</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Created At</th>
                                    <th width="25%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($services) > 0): ?>
                                    <?php foreach ($services as $srv): ?>
                                        <tr>
                                            <td><?php echo $srv['id']; ?></td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 40px; height: 40px;">
                                                    <i class="<?php echo htmlspecialchars($srv['icon']); ?> text-primary"></i>
                                                </div>
                                            </td>
                                            <td class="fw-bold"><?php echo htmlspecialchars($srv['service_name']); ?></td>
                                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($srv['category']); ?></span></td>
                                            <td>
                                                <span id="status-badge-<?php echo $srv['id']; ?>" class="badge <?php echo $srv['status'] == 1 ? 'bg-success' : 'bg-danger'; ?>">
                                                    <?php echo $srv['status'] == 1 ? 'Active' : 'Inactive'; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('M d, Y', strtotime($srv['created_at'])); ?></td>
                                            <td>
                                                <a href="services.php?action=edit&id=<?php echo $srv['id']; ?>" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                                <a href="services.php?action=delete&id=<?php echo $srv['id']; ?>" class="btn btn-sm btn-outline-danger me-1" onclick="return confirm('Are you sure you want to delete this service?');" title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                                <button onclick="toggleServiceStatus(this, <?php echo $srv['id']; ?>)" class="btn btn-sm <?php echo $srv['status'] == 1 ? 'btn-warning' : 'btn-success'; ?>" title="<?php echo $srv['status'] == 1 ? 'Disable' : 'Enable'; ?>">
                                                    <i class="fa-solid <?php echo $srv['status'] == 1 ? 'fa-ban' : 'fa-check'; ?>"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">No services found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif ($active_tab === 'requests'): ?>
            <!-- Service Requests Content -->
             <?php require __DIR__ . '/service_requests_list.php'; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function toggleServiceStatus(btn, id) {
    const isDisableAction = btn.classList.contains('btn-warning');
    const newStatus = isDisableAction ? 0 : 1;
    const originalContent = btn.innerHTML;
    
    // Loading state
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
    
    fetch('ajax_service_action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            action: 'toggle_status',
            id: id,
            status: newStatus
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update Badge
            const badge = document.getElementById('status-badge-' + id);
            if (newStatus === 1) {
                badge.className = 'badge bg-success';
                badge.textContent = 'Active';
                
                // Update Button to "Disable" state
                btn.className = 'btn btn-sm btn-warning';
                btn.title = 'Disable';
                btn.innerHTML = '<i class="fa-solid fa-ban"></i>';
            } else {
                badge.className = 'badge bg-danger';
                badge.textContent = 'Inactive';
                
                // Update Button to "Enable" state
                btn.className = 'btn btn-sm btn-success';
                btn.title = 'Enable';
                btn.innerHTML = '<i class="fa-solid fa-check"></i>';
            }
        } else {
            alert('Error: ' + data.message);
            btn.innerHTML = originalContent;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating status.');
        btn.innerHTML = originalContent;
    })
    .finally(() => {
        btn.disabled = false;
    });
}
</script>