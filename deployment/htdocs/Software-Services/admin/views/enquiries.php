<?php
// Filter out Service inquiries from this view as they are managed in "Service Requests"
$list = array_filter($list, function($item) {
    return $item['inquiry_type'] !== 'Service';
});

// Split inquiries into lists
$course_inquiries = [];

foreach ($list as $item) {
    if ($item['inquiry_type'] === 'Course') {
        $course_inquiries[] = $item;
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Manage Inquiries</h3>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card-modern p-3">
            <form method="get" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label text-muted small text-uppercase fw-bold">Filter by Date</label>
                    <input type="date" name="date" class="form-control" value="<?php echo htmlspecialchars($date_filter); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small text-uppercase fw-bold">Filter by Type</label>
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="Course" <?php echo $type_filter === 'Course' ? 'selected' : ''; ?>>Course</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary me-2"><i class="fa-solid fa-filter me-2"></i>Filter</button>
                    <a href="enquiries.php" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (!empty($msg)): ?>
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fa-solid fa-check-circle me-2"></i><?php echo htmlspecialchars($msg); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Tabs -->
<ul class="nav nav-tabs mb-3" id="inquiryTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-pane" type="button" role="tab" aria-controls="all-pane" aria-selected="true">
        <i class="fa-solid fa-list me-2"></i>All Inquiries 
        <span class="badge bg-secondary ms-2 rounded-pill"><?php echo count($list); ?></span>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="course-tab" data-bs-toggle="tab" data-bs-target="#course-pane" type="button" role="tab" aria-controls="course-pane" aria-selected="false">
        <i class="fa-solid fa-book me-2"></i>Course Inquiries 
        <span class="badge bg-secondary ms-2 rounded-pill"><?php echo count($course_inquiries); ?></span>
    </button>
  </li>
</ul>

<div class="tab-content" id="inquiryTabsContent">
  <div class="tab-pane fade show active" id="all-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
      <?php render_inquiry_table($list); ?>
  </div>
  <div class="tab-pane fade" id="course-pane" role="tabpanel" aria-labelledby="course-tab" tabindex="0">
      <?php render_inquiry_table($course_inquiries); ?>
  </div>
</div>

<?php
function render_inquiry_table($items) {
    if (empty($items)) {
        echo '<div class="alert alert-light border text-center p-5"><i class="fa-regular fa-folder-open fa-2x mb-3 text-muted"></i><br>No inquiries found matching your criteria.</div>';
        return;
    }
    ?>
    <div class="table-responsive card-modern">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 15%;">Date</th>
                    <th style="width: 15%;">Name</th>
                    <th style="width: 20%;">Contact</th>
                    <th style="width: 20%;">Interest</th>
                    <th style="width: 20%;">Message</th>
                    <th style="width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $e): ?>
                <tr>
                    <td>
                        <div class="fw-medium"><?php echo date('M d, Y', strtotime($e['created_at'])); ?></div>
                        <div class="small text-muted"><?php echo date('h:i A', strtotime($e['created_at'])); ?></div>
                    </td>
                    <td>
                        <div class="fw-semibold"><?php echo htmlspecialchars($e['name']); ?></div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center mb-1">
                            <i class="fa-solid fa-phone text-muted me-2" style="width:16px"></i> 
                            <?php echo htmlspecialchars($e['mobile']); ?>
                        </div>
                        <?php if(!empty($e['email'])): ?>
                        <div class="d-flex align-items-center">
                            <i class="fa-regular fa-envelope text-muted me-2" style="width:16px"></i> 
                            <span class="text-truncate" style="max-width: 150px;" title="<?php echo htmlspecialchars($e['email']); ?>">
                                <?php echo htmlspecialchars($e['email']); ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 mb-1"><?php echo htmlspecialchars($e['inquiry_type']); ?></span>
                        <div class="fw-medium text-wrap"><?php echo htmlspecialchars($e['reference_name']); ?></div>
                    </td>
                    <td>
                        <div class="text-muted small text-wrap" style="max-height: 80px; overflow-y: auto;">
                            <?php echo nl2br(htmlspecialchars($e['message'])); ?>
                        </div>
                    </td>
                    <td>
                        <form method="post" class="d-flex flex-column gap-2">
                            <input type="hidden" name="id" value="<?php echo (int)$e['id']; ?>">
                            <select name="status" class="form-select form-select-sm <?php 
                                echo match($e['status']) {
                                    'Pending' => 'border-warning text-warning',
                                    'Read' => 'border-primary text-primary',
                                    'Closed' => 'border-success text-success',
                                    default => ''
                                };
                            ?>" onchange="this.form.submit()">
                                <option value="Pending" <?php echo $e['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="Read" <?php echo $e['status'] === 'Read' ? 'selected' : ''; ?>>Read</option>
                                <option value="Closed" <?php echo $e['status'] === 'Closed' ? 'selected' : ''; ?>>Closed</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>
