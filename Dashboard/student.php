<?php
require_once '../config.php';
require_once '../functions.php';
require_role(['student']);
include '../header.php';
$user = current_user();
?>
<div class="container mt-4">
  <h2>Student Dashboard</h2>
  <p>Welcome, <?php echo e($user['full_name']); ?></p>
  <div class="row">
    <div class="col-md-6">
      <div class="card p-3">
        <h5>My Courses</h5>
        <p><a href="#" class="btn btn-sm btn-outline-primary">View Enrollments</a></p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-3">
        <h5>Browse Courses</h5>
        <p><a href="#" class="btn btn-sm btn-outline-primary">Browse</a></p>
      </div>
    </div>
  </div>
</div>
<?php include '../footer.php'; ?>
