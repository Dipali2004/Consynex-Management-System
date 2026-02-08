<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0"><?php echo isset($course) ? 'Edit Course' : 'Add New Course'; ?></h2>
    <a href="courses.php" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Back to List</a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card-modern p-4">
    <form method="post" action="courses.php?action=<?php echo isset($course) ? 'edit' : 'add'; ?>" enctype="multipart/form-data">
        <?php if (isset($course['id'])): ?>
            <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
            <input type="hidden" name="existing_image" value="<?php echo isset($course['image']) ? $course['image'] : ''; ?>">
        <?php endif; ?>
        
        <div class="row g-4">
            <div class="col-md-6">
                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Professional Courses" <?php echo (isset($course) && $course['category'] === 'Professional Courses') ? 'selected' : ''; ?>>Professional Courses</option>
                    <option value="Programming Languages" <?php echo (isset($course) && $course['category'] === 'Programming Languages') ? 'selected' : ''; ?>>Programming Languages</option>
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="course_name" class="form-label">Course Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo isset($course) ? htmlspecialchars($course['course_name']) : ''; ?>" required>
            </div>
            
            <div class="col-12">
                <label for="description" class="form-label">Short Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo isset($course) ? htmlspecialchars($course['description']) : ''; ?></textarea>
            </div>
            
            <div class="col-md-6">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" placeholder="e.g. 3 Months" value="<?php echo isset($course) ? htmlspecialchars($course['duration']) : ''; ?>">
            </div>

            <div class="col-md-6">
                <label for="fees" class="form-label">Fees</label>
                <div class="input-group">
                    <span class="input-group-text">₹</span>
                    <input type="text" class="form-control" id="fees" name="fees" placeholder="e.g. 15000" value="<?php echo isset($course) ? htmlspecialchars($course['fees']) : ''; ?>">
                </div>
            </div>
            
            <div class="col-md-6">
                <label for="image" class="form-label">Course Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <?php if (isset($course['image']) && !empty($course['image'])): ?>
                    <div class="mt-2">
                        <img src="../<?php echo htmlspecialchars($course['image']); ?>" alt="Current Image" class="img-thumbnail" style="max-height: 100px;">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="col-md-6 d-flex align-items-center">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="status" name="status" <?php echo (!isset($course) || $course['status'] == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status">Active Course</label>
                </div>
            </div>
            
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-save me-2"></i><?php echo isset($course) ? 'Update Course' : 'Create Course'; ?>
                </button>
            </div>
        </div>
    </form>
</div>
