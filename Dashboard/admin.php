<?php
require_once '../config.php';
require_once '../functions.php';
require_role(['admin']);
include '../header.php';
$user = current_user();
?>
<div class="container mt-4">
  <h2>Admin Dashboard</h2>
  <p>Welcome, <?php echo e($user['full_name']); ?> — Role: <?php echo e($user['role']); ?></p>

  <div class="row">
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Manage Users</h5>
        <p><a href="#" class="btn btn-sm btn-outline-primary">View Users</a></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Manage Courses</h5>
        <p><a href="#" class="btn btn-sm btn-outline-primary">View Courses</a></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Reports</h5>
        <p><a href="#" class="btn btn-sm btn-outline-primary">Export</a></p>
      </div>
    </div>
  </div>
</div>

<?php include '../footer.php'; ?>
