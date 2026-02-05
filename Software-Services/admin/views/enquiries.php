<?php
?>
<div class="row">
  <div class="col-12">
    <h3>Enquiries</h3>
    <?php if (!empty($msg)): ?><div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Message</th>
          <th>Source</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($list as $e): ?>
          <tr>
            <td><?php echo (int)$e['id']; ?></td>
            <td><?php echo htmlspecialchars($e['name']); ?></td>
            <td><?php echo htmlspecialchars($e['email']); ?></td>
            <td><?php echo htmlspecialchars($e['phone']); ?></td>
            <td><?php echo htmlspecialchars($e['message']); ?></td>
            <td><?php echo htmlspecialchars($e['source']); ?></td>
            <td><?php echo htmlspecialchars($e['status']); ?></td>
            <td>
              <form method="post" class="d-flex">
                <input type="hidden" name="id" value="<?php echo (int)$e['id']; ?>">
                <select name="status" class="form-select form-select-sm me-2">
                  <option value="new" <?php echo $e['status']==='new'?'selected':''; ?>>new</option>
                  <option value="processing" <?php echo $e['status']==='processing'?'selected':''; ?>>processing</option>
                  <option value="closed" <?php echo $e['status']==='closed'?'selected':''; ?>>closed</option>
                </select>
                <button class="btn btn-sm btn-primary">Update</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  </div>

