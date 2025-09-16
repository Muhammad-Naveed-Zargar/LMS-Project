<?php
require_once '../config.php';
require_once '../functions.php';
require_role(['instructor']);
include '../header.php';
$user = current_user();
?>
<div class="container mt-4">
  <h2>Instructor Dashboard</h2>
  <p>Welcome, <?php echo e($user['full_name']); ?></p>
  <div class="row">
    <div class="col-md-6">
      <div class="card p-3">
        <h5>Your Courses</h5>
        <p><a href="#" class="btn btn-sm btn-outline-primary">Create / Manage</a></p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-3">
        <h5>Upload Material</h5>
        <p><a href="#" class="btn btn-sm btn-outline-primary">Upload</a></p>
      </div>
    </div>
  </div>
</div>
<?php include '../footer.php'; ?>
