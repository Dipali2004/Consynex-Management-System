<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0"><?php echo isset($item) ? 'Edit' : 'Add'; ?> Gallery Image</h2>
    <a href="gallery.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Back to List</a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="" method="POST" enctype="multipart/form-data">
            <?php if (isset($item)): ?>
                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($item['image_path']); ?>">
            <?php endif; ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Image Title (Optional)</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>" placeholder="e.g. Office Reception">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category" class="form-select" required>
                        <option value="">Select Category</option>
                        <?php 
                        $categories = ['Office', 'Training', 'Events', 'Infrastructure', 'Services'];
                        foreach ($categories as $cat) {
                            $selected = (isset($item) && $item['category'] === $cat) ? 'selected' : '';
                            echo "<option value=\"$cat\" $selected>$cat</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Upload Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*" <?php echo isset($item) ? '' : 'required'; ?>>
                    <?php if (isset($item) && !empty($item['image_path'])): ?>
                        <div class="mt-2">
                            <small class="text-muted">Current Image:</small>
                            <div class="mt-1">
                                <img src="../<?php echo htmlspecialchars($item['image_path']); ?>" alt="Current" class="img-thumbnail" style="height: 100px;">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-text">Allowed formats: JPG, PNG, GIF, WEBP. Max size: 5MB.</div>
                </div>

                <div class="col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" <?php echo (!isset($item) || $item['status'] == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-2"></i><?php echo isset($item) ? 'Update' : 'Save'; ?> Image
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
