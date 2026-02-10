<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0"><?php echo isset($service) ? 'Edit Service' : 'Add New Service'; ?></h2>
    <a href="services.php" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Back to List</a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card-modern p-4">
    <form method="post" action="services.php?action=<?php echo isset($service) ? 'edit' : 'add'; ?>&id=<?php echo isset($service) ? $service['id'] : ''; ?>">
        <?php if (isset($service)): ?>
            <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
        <?php endif; ?>
        
        <div class="row g-4">
            <div class="col-md-6">
                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Core IT" <?php echo (isset($service) && $service['category'] === 'Core IT') ? 'selected' : ''; ?>>Core IT</option>
                    <option value="Networking & Office IT" <?php echo (isset($service) && $service['category'] === 'Networking & Office IT') ? 'selected' : ''; ?>>Networking & Office IT</option>
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="service_name" class="form-label">Service Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="service_name" name="service_name" value="<?php echo isset($service) ? htmlspecialchars($service['service_name']) : ''; ?>" required>
            </div>
            
            <div class="col-12">
                <label for="description" class="form-label">Short Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo isset($service) ? htmlspecialchars($service['description']) : ''; ?></textarea>
            </div>
            
            <div class="col-md-6">
                <label for="icon" class="form-label">Icon Class (Bootstrap Icons / FontAwesome)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-star"></i></span>
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="e.g. bi bi-laptop" value="<?php echo isset($service) ? htmlspecialchars($service['icon']) : ''; ?>">
                </div>
                <div class="form-text">Use Bootstrap Icons (bi bi-*) or FontAwesome (fa-solid fa-*).</div>
            </div>
            
            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="status" name="status" <?php echo (!isset($service) || $service['status'] == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status">Active Service</label>
                </div>
            </div>
            
            <div class="col-12 mt-4">
                <button type="submit" name="save_service" class="btn btn-primary px-4">
                    <i class="fa-solid fa-save me-2"></i><?php echo isset($service) ? 'Update Service' : 'Create Service'; ?>
                </button>
            </div>
        </div>
    </form>
</div>
